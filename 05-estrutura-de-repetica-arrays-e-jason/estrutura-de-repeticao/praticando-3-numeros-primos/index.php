<?php
function numeroEhPrimo(int $numero): bool
{
    if ($numero < 2) {
        return false;
    }

    for ($divisor = 2; $divisor * $divisor <= $numero; $divisor++) {
        if ($numero % $divisor === 0) {
            return false;
        }
    }

    return true;
}

$links = [1, 2, 3, 5, 20, 32, 37];
$numero = filter_input(INPUT_GET, 'numero', FILTER_VALIDATE_INT);
$numeroInformado = filter_input(INPUT_GET, 'numero', FILTER_DEFAULT);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<title>Praticando 3 - Números primos</title>
<link rel="stylesheet" href="../style.css">
</head>
<body>

<div class="page">
    <h1>Praticando 3 - Números primos</h1>
    <hr>

    <div class="links-inline">
        <?php foreach ($links as $link): ?>
            <a href="?numero=<?= $link ?>">Número <?= $link ?></a>
        <?php endforeach; ?>
    </div>

    <?php if ($numeroInformado !== null && $numero !== false): ?>
        <?php
        $ehPrimo = numeroEhPrimo($numero);
        $paridade = $numero % 2 === 0 ? 'PAR' : 'ÍMPAR';
        ?>
        <div class="mensagem-primo">
            <p>
                O número
                <span class="destaque"><?= htmlspecialchars((string) $numero, ENT_QUOTES, 'UTF-8') ?></span>
                <span class="destaque"><?= $ehPrimo ? 'é' : 'não é' ?></span>
                um número
                <span class="destaque">PRIMO</span>.
            </p>
            <p>
                Além disso ele é um número
                <span class="destaque"><?= $paridade ?></span>
            </p>
        </div>
    <?php elseif ($numeroInformado !== null): ?>
        <div class="mensagem-primo">
            <p>Informe um número inteiro válido pela URL, por exemplo: <code>?numero=99</code>.</p>
        </div>
    <?php endif; ?>

    <p class="voltar"><a class="back-link" href="../index.php">Voltar ao menu</a></p>
</div>

</body>
</html>
