<?php
$inicio = filter_input(INPUT_POST, 'inicio', FILTER_VALIDATE_INT);
$final = filter_input(INPUT_POST, 'final', FILTER_VALIDATE_INT);
$incremento = filter_input(INPUT_POST, 'incremento', FILTER_VALIDATE_INT);

$parametrosValidos = $inicio !== false && $inicio !== null
    && $final !== false && $final !== null
    && $incremento !== false && $incremento !== null;

if ($parametrosValidos && $incremento <= 0) {
    $incremento = 1;
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<title>Contador</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="../style.css">
</head>
<body>

<div class="page">
    <h1>Contador</h1>
    <hr>

    <?php if ($parametrosValidos): ?>
        <div class="bloco-resultado">
            <strong>Parâmetros informados:</strong>
            <p>Início: <?= htmlspecialchars((string) $inicio, ENT_QUOTES, 'UTF-8') ?></p>
            <p>Final: <?= htmlspecialchars((string) $final, ENT_QUOTES, 'UTF-8') ?></p>
            <p>Incremento: <?= htmlspecialchars((string) $incremento, ENT_QUOTES, 'UTF-8') ?></p>

            <div class="sequencia">
                <?php
                if ($inicio <= $final) {
                    for ($numero = $inicio; $numero <= $final; $numero += $incremento) {
                        echo htmlspecialchars((string) $numero, ENT_QUOTES, 'UTF-8') . ' ';
                    }
                } else {
                    for ($numero = $inicio; $numero >= $final; $numero -= $incremento) {
                        echo htmlspecialchars((string) $numero, ENT_QUOTES, 'UTF-8') . ' ';
                    }
                }
                ?>
            </div>
        </div>
    <?php else: ?>
        <p>Informe valores inteiros válidos para início, final e incremento.</p>
    <?php endif; ?>

    <p class="voltar"><a class="back-link" href="formulario.php">Redefinir</a></p>
    <p><a class="back-link" href="../index.php">Voltar ao menu</a></p>
</div>

</body>
</html>
