<?php
declare(strict_types=1);

require_once __DIR__ . '/config.php';

prepararSessaoProjeto();

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

function prepararSessaoProjeto(): void
{
    $diretorioBase = __DIR__ . '/dados';
    $diretorioSessao = $diretorioBase . '/sessoes';

    if (!is_dir($diretorioBase)) {
        mkdir($diretorioBase, 0775, true);
    }

    if (!is_dir($diretorioSessao)) {
        mkdir($diretorioSessao, 0775, true);
    }

    session_name('contador_t1');
    session_save_path($diretorioSessao);
}

function caminhoDados(string $arquivo): string
{
    return __DIR__ . '/dados/' . $arquivo;
}

function garantirEstruturaDados(): void
{
    $diretorio = __DIR__ . '/dados';

    if (!is_dir($diretorio)) {
        mkdir($diretorio, 0775, true);
    }

    $caminhoContadores = caminhoDados('contadores.txt');
    $caminhoLogs = caminhoDados('logs.txt');

    if (!is_file($caminhoContadores)) {
        salvarContadores(contadoresPadrao());
    }

    if (!is_file($caminhoLogs)) {
        file_put_contents($caminhoLogs, '', LOCK_EX);
    }
}

function contadoresPadrao(): array
{
    $contadores = [];

    foreach (PAGINAS_TRABALHO as $arquivo => $dados) {
        $contadores[$arquivo] = 0;
    }

    return $contadores;
}

function lerContadores(): array
{
    garantirEstruturaDados();

    $contadores = contadoresPadrao();
    $linhas = file(caminhoDados('contadores.txt'), FILE_IGNORE_NEW_LINES);

    if (!is_array($linhas)) {
        return $contadores;
    }

    foreach ($linhas as $linha) {
        if (!str_contains($linha, '=')) {
            continue;
        }

        [$arquivo, $valor] = array_pad(explode('=', $linha, 2), 2, '0');
        $arquivo = trim($arquivo);

        if (!array_key_exists($arquivo, $contadores)) {
            continue;
        }

        $contadores[$arquivo] = max(0, (int) trim($valor));
    }

    return $contadores;
}

function salvarContadores(array $contadores): void
{
    $linhas = [];

    foreach (contadoresPadrao() as $arquivo => $valorPadrao) {
        $linhas[] = $arquivo . '=' . max(0, (int) ($contadores[$arquivo] ?? $valorPadrao));
    }

    file_put_contents(caminhoDados('contadores.txt'), implode(PHP_EOL, $linhas) . PHP_EOL, LOCK_EX);
}

function registrarAcesso(string $arquivo): void
{
    garantirEstruturaDados();

    $contadores = lerContadores();

    if (!array_key_exists($arquivo, $contadores)) {
        return;
    }

    $contadores[$arquivo] += 1;
    salvarContadores($contadores);
    registrarLog($arquivo);
}

function registrarLog(string $arquivo): void
{
    $linha = implode('|', [
        $arquivo,
        date('d/m/Y H:i:s'),
        normalizarTextoLog(ipUsuario()),
        normalizarTextoLog(navegadorUsuario()),
    ]);

    file_put_contents(caminhoDados('logs.txt'), $linha . PHP_EOL, FILE_APPEND | LOCK_EX);
}

function normalizarTextoLog(string $valor): string
{
    $valor = trim($valor);
    $valor = str_replace(["\r", "\n", '|'], [' ', ' ', '/'], $valor);

    return $valor !== '' ? $valor : 'Não informado';
}

function listarLogs(): array
{
    garantirEstruturaDados();

    $linhas = file(caminhoDados('logs.txt'), FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    if (!is_array($linhas)) {
        return [];
    }

    $registros = [];

    foreach ($linhas as $indice => $linha) {
        [$arquivo, $dataHora, $ip, $navegador] = array_pad(explode('|', $linha, 4), 4, 'Não informado');

        $registros[] = [
            'contador' => $indice + 1,
            'arquivo' => trim($arquivo),
            'pagina' => nomePaginaArquivo(trim($arquivo)),
            'data_hora' => trim($dataHora),
            'ip' => trim($ip),
            'navegador' => trim($navegador),
        ];
    }

    return $registros;
}

function nomePaginaArquivo(string $arquivo): string
{
    if (isset(PAGINAS_TRABALHO[$arquivo]['menu'])) {
        return (string) PAGINAS_TRABALHO[$arquivo]['menu'];
    }

    return $arquivo;
}

function estatisticasOrdenadas(): array
{
    $contadores = lerContadores();
    $estatisticas = [];

    foreach ($contadores as $arquivo => $quantidade) {
        $estatisticas[] = [
            'arquivo' => $arquivo,
            'quantidade' => $quantidade,
            'menu' => nomePaginaArquivo($arquivo),
        ];
    }

    usort(
        $estatisticas,
        static function (array $primeiro, array $segundo): int {
            if ($primeiro['quantidade'] === $segundo['quantidade']) {
                return strcmp((string) $primeiro['menu'], (string) $segundo['menu']);
            }

            return $segundo['quantidade'] <=> $primeiro['quantidade'];
        }
    );

    return $estatisticas;
}

function totalAcessos(): int
{
    return array_sum(lerContadores());
}

function limparContador(string $arquivo): bool
{
    $contadores = lerContadores();

    if (!array_key_exists($arquivo, $contadores)) {
        return false;
    }

    $contadores[$arquivo] = 0;
    salvarContadores($contadores);

    return true;
}

function limparTodosContadores(): void
{
    salvarContadores(contadoresPadrao());
}

function limparLogs(): void
{
    garantirEstruturaDados();
    file_put_contents(caminhoDados('logs.txt'), '', LOCK_EX);
}

function autenticado(): bool
{
    return isset($_SESSION['auth_logs']) && $_SESSION['auth_logs'] === true;
}

function autenticar(string $chave): bool
{
    $valida = hash_equals(CHAVE_ACESSO, trim($chave));

    if ($valida) {
        $_SESSION['auth_logs'] = true;
    }

    return $valida;
}

function encerrarSessaoAcesso(): void
{
    unset($_SESSION['auth_logs']);
}

function definirFlash(string $tipo, string $mensagem): void
{
    $_SESSION['flash'] = [
        'tipo' => $tipo,
        'mensagem' => $mensagem,
    ];
}

function consumirFlash(): ?array
{
    if (!isset($_SESSION['flash']) || !is_array($_SESSION['flash'])) {
        return null;
    }

    $flash = $_SESSION['flash'];
    unset($_SESSION['flash']);

    return $flash;
}

function ipUsuario(): string
{
    $encaminhado = $_SERVER['HTTP_X_FORWARDED_FOR'] ?? '';

    if (is_string($encaminhado) && $encaminhado !== '') {
        $partes = explode(',', $encaminhado);

        return trim($partes[0]);
    }

    $ip = $_SERVER['REMOTE_ADDR'] ?? '127.0.0.1';

    return is_string($ip) && $ip !== '' ? $ip : '127.0.0.1';
}

function navegadorUsuario(): string
{
    $agente = trim((string) ($_SERVER['HTTP_USER_AGENT'] ?? ''));

    if ($agente === '') {
        return 'Desconhecido';
    }

    $mapa = [
        'Edg' => 'Edge',
        'OPR' => 'Opera',
        'Chrome' => 'Chrome',
        'Firefox' => 'Firefox',
        'Safari' => 'Safari',
        'MSIE' => 'Internet Explorer',
        'Trident' => 'Internet Explorer',
    ];

    foreach ($mapa as $trecho => $nome) {
        if (str_contains($agente, $trecho)) {
            return $nome;
        }
    }

    return $agente;
}

function e(?string $valor): string
{
    return htmlspecialchars((string) $valor, ENT_QUOTES, 'UTF-8');
}

function caminhoAsset(string $arquivo): string
{
    return './' . ltrim($arquivo, './');
}

function rota(string $arquivo): string
{
    return './' . ltrim($arquivo, './');
}
