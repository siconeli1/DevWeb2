<?php
$linhas = filter_input(INPUT_POST, 'linhas', FILTER_VALIDATE_INT);
$colunas = filter_input(INPUT_POST, 'colunas', FILTER_VALIDATE_INT);
$estilo = filter_input(INPUT_POST, 'estilo', FILTER_DEFAULT);

$estilosPermitidos = [
    'table-primary',
    'table-success',
    'table-danger',
    'table-warning',
    'table-dark',
];

$parametrosValidos = $linhas !== false && $linhas !== null
    && $colunas !== false && $colunas !== null
    && in_array($estilo, $estilosPermitidos, true);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<title>Praticando 4 - Gerador de tabela</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="../style.css">
</head>
<body>

<div class="page">
    <h1>Praticando 4 - Gerador de tabela</h1>
    <hr>

    <?php if ($parametrosValidos): ?>
        <h2>Tabela</h2>

        <div class="tabela-wrap">
            <table class="table table-bordered <?= htmlspecialchars($estilo, ENT_QUOTES, 'UTF-8') ?>">
                <tbody>
                    <?php for ($linha = 0; $linha < $linhas; $linha++): ?>
                        <tr>
                            <?php for ($coluna = 0; $coluna < $colunas; $coluna++): ?>
                                <td>&nbsp;</td>
                            <?php endfor; ?>
                        </tr>
                    <?php endfor; ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <p>Informe valores válidos para linhas, colunas e estilo.</p>
    <?php endif; ?>

    <p class="voltar"><a class="back-link" href="formulario.php">Redefinir</a></p>
    <p><a class="back-link" href="../index.php">Voltar ao menu</a></p>
</div>

</body>
</html>
