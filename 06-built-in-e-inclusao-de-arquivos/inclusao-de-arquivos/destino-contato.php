<?php
date_default_timezone_set("America/Sao_Paulo");

$nome = trim((string) filter_input(INPUT_POST, "nome", FILTER_UNSAFE_RAW));
$email = trim((string) filter_input(INPUT_POST, "email", FILTER_UNSAFE_RAW));
$mensagem = trim((string) filter_input(INPUT_POST, "mensagem", FILTER_UNSAFE_RAW));
$emailFormatoValido = (bool) preg_match('/^[^\\s@]+@[^\\s@]+\\.[^\\s@]+$/', $email);
$dataHora = new DateTimeImmutable();
$dataFormatada = $dataHora->format("d/m/Y");
$horaFormatada = $dataHora->format("H:i:s");

$tituloPagina = "Destino contato";
$paginaAtual = "contato";

require_once __DIR__ . "/header.php";
?>

<div class="pagina-destino">
    <div class="titulo-pagina">
        <h1 class="text-center">Destino contato</h1>
    </div>

    <?php if ($nome === "" || $email === "" || $mensagem === "" || !$emailFormatoValido): ?>
        <div class="alert alert-danger" role="alert">
            <p class="mb-0">Preencha nome, e-mail no formato correto e mensagem antes de enviar o formul&aacute;rio.</p>
        </div>
        <p class="mt-4">
            <a href="contato.php" class="btn btn-primary">Voltar</a>
        </p>
    <?php else: ?>
        <?php
        $diretorioContatos = __DIR__ . "/contatos";

        if (!is_dir($diretorioContatos)) {
            mkdir($diretorioContatos, 0777, true);
        }

        $conteudoArquivo = "Identificacao de contato via site" . PHP_EOL;
        $conteudoArquivo .= "Data: {$dataFormatada} {$horaFormatada}" . PHP_EOL;
        $conteudoArquivo .= "Nome: {$nome}" . PHP_EOL;
        $conteudoArquivo .= "Email: {$email}" . PHP_EOL;
        $conteudoArquivo .= "Mensagem: {$mensagem}" . PHP_EOL;

        $nomeArquivo = "contato-" . $dataHora->format("Ymd-His-u") . ".txt";
        file_put_contents($diretorioContatos . "/" . $nomeArquivo, $conteudoArquivo);
        ?>

        <div class="dados-contato">
            <p><strong>Nome:</strong> <?= htmlspecialchars($nome, ENT_QUOTES, "UTF-8") ?></p>
            <p><strong>E-mail:</strong> <?= htmlspecialchars($email, ENT_QUOTES, "UTF-8") ?></p>
            <p><strong>Data:</strong> <?= htmlspecialchars($dataFormatada, ENT_QUOTES, "UTF-8") ?></p>
            <p><strong>Hora:</strong> <?= htmlspecialchars($horaFormatada, ENT_QUOTES, "UTF-8") ?></p>
            <p><strong>Mensagem:</strong> <?= nl2br(htmlspecialchars($mensagem, ENT_QUOTES, "UTF-8")) ?></p>
            <p class="mt-4">
                <a href="contato.php" class="btn btn-primary">Voltar</a>
            </p>
        </div>
    <?php endif; ?>
</div>

<?php require_once __DIR__ . "/footer.php"; ?>
