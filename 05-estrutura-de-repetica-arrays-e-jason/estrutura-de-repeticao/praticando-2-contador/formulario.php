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

    <form class="form-centralizado" action="destino.php" method="POST">
        <div class="form-linha compacta">
            <label for="inicio">Início:</label>
            <input class="form-control form-control-lg" type="number" id="inicio" name="inicio" required>
        </div>

        <div class="form-linha compacta">
            <label for="final">Final:</label>
            <input class="form-control form-control-lg" type="number" id="final" name="final" required>
        </div>

        <div class="form-linha compacta">
            <label for="incremento">Incremento:</label>
            <input class="form-control form-control-lg" type="number" id="incremento" name="incremento" min="1" required>
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
