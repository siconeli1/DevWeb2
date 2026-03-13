<?php
$tituloPagina = "Contato";
$paginaAtual = "contato";

require_once __DIR__ . "/header.php";
?>

<div class="pagina-conteudo form-contato">
    <div class="bg-light p-4 mb-4 rounded">
        <h1 class="text-center">Contato</h1>
    </div>

    <form action="destino-contato.php" method="post" class="row g-3">
        <div class="col-md-6">
            <label for="nome" class="form-label">Nome</label>
            <input type="text" class="form-control" id="nome" name="nome" required>
        </div>

        <div class="col-md-6">
            <label for="email" class="form-label">E-mail</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>

        <div class="col-12">
            <label for="mensagem" class="form-label">Mensagem</label>
            <textarea class="form-control" id="mensagem" name="mensagem" required></textarea>
        </div>

        <div class="col-12">
            <button type="submit" class="btn btn-primary">Enviar</button>
        </div>
    </form>
</div>

<?php require_once __DIR__ . "/footer.php"; ?>
