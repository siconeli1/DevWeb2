<?php
declare(strict_types=1);

require_once __DIR__ . '/includes/layout.php';

$mensagemErroChave = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $acao = trim((string) ($_POST['acao'] ?? ''));

    if ($acao === 'login') {
        $chave = (string) ($_POST['chave'] ?? '');

        if (autenticar($chave)) {
            definirFlash('success', 'Autenticação realizada com sucesso.');
            header('Location: ' . rota('logs.php'));
            exit;
        }

        $mensagemErroChave = 'Chave incorreta!';
    } elseif (!autenticado()) {
        definirFlash('error', 'Acesso indevido. Faça autenticação para continuar.');
        header('Location: ' . rota('logs.php'));
        exit;
    } elseif ($acao === 'limpar_individual') {
        $arquivo = trim((string) ($_POST['arquivo'] ?? ''));

        if (limparContador($arquivo)) {
            definirFlash('success', 'A contagem de acessos de ' . nomePaginaArquivo($arquivo) . ' foi apagada com sucesso.');
        } else {
            definirFlash('error', 'Não foi possível limpar a contagem solicitada.');
        }

        header('Location: ' . rota('logs.php'));
        exit;
    } elseif ($acao === 'limpar_contadores') {
        limparTodosContadores();
        definirFlash('success', 'Todos os contadores de acesso foram apagados com sucesso.');
        header('Location: ' . rota('logs.php'));
        exit;
    } elseif ($acao === 'limpar_logs') {
        limparLogs();
        definirFlash('success', 'Todos os registros de acesso foram apagados com sucesso.');
        header('Location: ' . rota('logs.php'));
        exit;
    } else {
        definirFlash('error', 'Ação inválida.');
        header('Location: ' . rota('logs.php'));
        exit;
    }
}

$flash = consumirFlash();
$estatisticas = autenticado() ? estatisticasOrdenadas() : [];
$registros = autenticado() ? listarLogs() : [];

renderizarCabecalho('logs.php', 'Logs de Acesso');
?>
<section class="logs-panel">
    <h1 class="logs-panel__title">Logs de Acesso</h1>

    <?php if ($flash !== null): ?>
        <div class="flash<?= $flash['tipo'] === 'error' ? ' flash--error' : '' ?>">
            <?= e((string) $flash['mensagem']) ?>
        </div>
    <?php endif; ?>

    <?php if (!autenticado()): ?>
        <div class="access-box">
            <h2>Access key</h2>

            <form action="<?= e(rota('logs.php')) ?>" method="post">
                <input type="hidden" name="acao" value="login">
                <input class="field-input" type="password" name="chave" placeholder="Key" autocomplete="off">
                <button class="button button--blue button--small" type="submit">Entrar</button>
            </form>

            <?php if ($mensagemErroChave !== ''): ?>
                <div class="inline-error">
                    <span class="inline-error__icon">!</span>
                    <span><?= e($mensagemErroChave) ?></span>
                </div>
            <?php endif; ?>
        </div>
    <?php else: ?>
        <div class="stats-layout">
            <div>
                <div class="stats-grid">
                    <?php foreach ($estatisticas as $estatistica): ?>
                        <article class="stat-card">
                            <div class="stat-card__label"><?= e((string) $estatistica['menu']) ?></div>
                            <div class="stat-card__count"><?= e((string) $estatistica['quantidade']) ?> Acessos</div>
                            <form action="<?= e(rota('logs.php')) ?>" method="post" onsubmit="return confirm('Tem certeza que deseja limpar os acessos desta página?');">
                                <input type="hidden" name="acao" value="limpar_individual">
                                <input type="hidden" name="arquivo" value="<?= e((string) $estatistica['arquivo']) ?>">
                                <button class="button button--light button--small" type="submit">Limpar</button>
                            </form>
                        </article>
                    <?php endforeach; ?>
                </div>

                <div class="stat-total">Total de Acessos: <?= e((string) totalAcessos()) ?></div>

                <div class="stat-actions">
                    <form action="<?= e(rota('logs.php')) ?>" method="post" onsubmit="return confirm('Tem certeza que deseja limpar TODO o arquivo de acesso de todas as páginas?');">
                        <input type="hidden" name="acao" value="limpar_contadores">
                        <button class="button button--danger button--small" type="submit">Limpar todos os acessos</button>
                    </form>

                    <form action="<?= e(rota('logs.php')) ?>" method="post" onsubmit="return confirm('Tem certeza que deseja REMOVER o log de acesso? Essa ação exclui todos os registros.');">
                        <input type="hidden" name="acao" value="limpar_logs">
                        <button class="button button--danger button--small" type="submit">Limpar Log</button>
                    </form>
                </div>

                <div class="logs-list-title">Registros de Acesso</div>
                <div class="logs-table-wrapper">
                    <?php if ($registros === []): ?>
                        <p class="empty-state">Nenhum registro de acesso encontrado.</p>
                    <?php else: ?>
                        <table class="logs-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Página</th>
                                    <th>Data e Hora</th>
                                    <th>IP</th>
                                    <th>Navegador</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($registros as $registro): ?>
                                    <tr>
                                        <td><?= e((string) $registro['contador']) ?></td>
                                        <td><?= e((string) $registro['arquivo']) ?></td>
                                        <td><?= e((string) $registro['data_hora']) ?></td>
                                        <td><?= e((string) $registro['ip']) ?></td>
                                        <td><?= e((string) $registro['navegador']) ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php endif; ?>
                </div>
            </div>

            <div class="logs-illustration">
                <img src="<?= e(caminhoAsset('assets/img/log-icon.svg')) ?>" alt="Ícone de log">
            </div>
        </div>
    <?php endif; ?>
</section>
<?php renderizarRodape(); ?>
