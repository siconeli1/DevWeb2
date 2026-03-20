<?php
$tituloPagina = "Contato";
$paginaAtual = "contato";

require_once __DIR__ . "/header.php";
?>

<div class="pagina-conteudo form-contato">
    <div class="titulo-pagina">
        <h1 class="text-center">Formulário para CACHORRO</h1>
    </div>

    <form action="destino-contato.php" method="post" class="row g-3 justify-content-center">
        <div class="col-12 col-lg-4">
            <label for="nome" class="form-label">Nome</label>
            <input type="text" class="form-control" id="nome" name="nome" required>
        </div>

        <div class="col-12 col-lg-4">
            <label for="email" class="form-label">E-mail</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Digite seu email" required>
        </div>

        <div class="col-12 col-lg-8">
            <label for="mensagem" class="form-label">Mensagem</label>
            <textarea class="form-control" id="mensagem" name="mensagem" required></textarea>
        </div>

        <div class="col-12 text-center">
            <button type="submit" class="btn btn-primary">Enviar</button>
            <button type="reset" class="btn btn-warning">Limpar</button>
        </div>
    </form>
</div>

<?php require_once __DIR__ . "/footer.php"; ?>
