<?php
$valor = filter_input(INPUT_GET, 'valor', FILTER_VALIDATE_INT);
$valorInformado = filter_input(INPUT_GET, 'valor', FILTER_DEFAULT);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<title>Tabuada</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="../style.css">
</head>
<body>

<div class="page">
    <h1>Tabuada</h1>
    <hr>

    <form class="form-centralizado" action="" method="GET">
        <div class="form-linha">
            <label for="valor">Número:</label>
            <input class="form-control form-control-lg" type="number" id="valor" name="valor" value="<?= htmlspecialchars((string) ($valorInformado ?? ''), ENT_QUOTES, 'UTF-8') ?>">
        </div>

        <div class="acoes">
            <button class="btn btn-success btn-lg" type="submit">Enviar</button>
            <button class="btn btn-warning btn-lg" type="button" onclick="window.location.href='index.php'">Limpar</button>
        </div>
    </form>

    <?php if ($valorInformado !== null && $valor !== false): ?>
        <div class="bloco-resultado">
            <h2>Tabuada do <?= htmlspecialchars((string) $valor, ENT_QUOTES, 'UTF-8') ?></h2>
            <ul class="fs-4 lh-lg">
                <?php for ($indice = 1; $indice <= 10; $indice++): ?>
                    <li><?= $valor ?> x <?= $indice ?> = <?= $valor * $indice ?></li>
                <?php endfor; ?>
            </ul>
        </div>
    <?php elseif ($valorInformado !== null): ?>
        <p>Informe um número inteiro válido.</p>
    <?php endif; ?>

    <p class="voltar"><a class="back-link" href="../index.php">Voltar ao menu</a></p>
</div>

</body>
</html>
