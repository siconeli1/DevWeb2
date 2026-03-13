<?php
date_default_timezone_set("America/Sao_Paulo");

$nome = trim((string) filter_input(INPUT_POST, "nome", FILTER_UNSAFE_RAW));
$email = trim((string) filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL));
$mensagem = trim((string) filter_input(INPUT_POST, "mensagem", FILTER_UNSAFE_RAW));
$dataHora = new DateTimeImmutable();
$dataFormatada = $dataHora->format("d/m/Y");
$horaFormatada = $dataHora->format("H:i:s");

$tituloPagina = "Destino contato";
$paginaAtual = "contato";

require_once __DIR__ . "/header.php";
?>

<div class="pagina-conteudo">
    <div class="bg-light p-4 mb-4 rounded">
        <h1 class="text-center">Destino contato</h1>
    </div>

    <?php if ($nome === "" || $email === "" || $mensagem === ""): ?>
        <div class="alert alert-danger" role="alert">
            Preencha nome, e-mail e mensagem corretamente antes de enviar o formulário.
        </div>
    <?php else: ?>
        <?php
        $diretorioContatos = __DIR__ . "/contatos";

        if (!is_dir($diretorioContatos)) {
            mkdir($diretorioContatos, 0777, true);
        }

        $conteudoArquivo = "Nome: {$nome}" . PHP_EOL;
        $conteudoArquivo .= "Email: {$email}" . PHP_EOL;
        $conteudoArquivo .= "Data: {$dataFormatada}" . PHP_EOL;
        $conteudoArquivo .= "Hora: {$horaFormatada}" . PHP_EOL;
        $conteudoArquivo .= "Mensagem: {$mensagem}" . PHP_EOL;

        $nomeArquivo = "contato-" . $dataHora->format("Ymd-His-u") . ".txt";
        file_put_contents($diretorioContatos . "/" . $nomeArquivo, $conteudoArquivo);
        ?>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title mb-4">Dados recebidos</h5>
                <p><strong>Nome:</strong> <?= htmlspecialchars($nome, ENT_QUOTES, "UTF-8") ?></p>
                <p><strong>E-mail:</strong> <?= htmlspecialchars($email, ENT_QUOTES, "UTF-8") ?></p>
                <p><strong>Data:</strong> <?= htmlspecialchars($dataFormatada, ENT_QUOTES, "UTF-8") ?></p>
                <p><strong>Hora:</strong> <?= htmlspecialchars($horaFormatada, ENT_QUOTES, "UTF-8") ?></p>
                <p class="mb-0"><strong>Mensagem:</strong> <?= nl2br(htmlspecialchars($mensagem, ENT_QUOTES, "UTF-8")) ?></p>
            </div>
        </div>
    <?php endif; ?>
</div>

<?php require_once __DIR__ . "/footer.php"; ?>
