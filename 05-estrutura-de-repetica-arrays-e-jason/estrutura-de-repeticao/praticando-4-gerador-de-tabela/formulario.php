<?php
$estilos = [
    'table-primary' => 'table-primary',
    'table-success' => 'table-success',
    'table-danger' => 'table-danger',
    'table-warning' => 'table-warning',
    'table-dark' => 'table-dark',
];
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

    <form action="destino.php" method="POST">
        <div class="form-linha">
            <label for="linhas">Linhas:</label>
            <input class="form-control form-control-lg" type="number" name="linhas" id="linhas" min="1" required>

            <label for="colunas">Colunas:</label>
            <input class="form-control form-control-lg" type="number" name="colunas" id="colunas" min="1" required>

            <label for="estilo">Estilo:</label>
            <select class="form-select form-select-lg" name="estilo" id="estilo" required>
                <?php foreach ($estilos as $valor => $texto): ?>
                    <option value="<?= htmlspecialchars($valor, ENT_QUOTES, 'UTF-8') ?>"><?= htmlspecialchars($texto, ENT_QUOTES, 'UTF-8') ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="acoes">
            <button class="btn btn-success btn-lg" type="submit">Enviar</button>
            <button class="btn btn-warning btn-lg" type="reset">Limpar</button>
        </div>
    </form>

    <p class="voltar"><a class="back-link" href="../index.php">Voltar ao menu</a></p>
</div>

</body>
</html>
