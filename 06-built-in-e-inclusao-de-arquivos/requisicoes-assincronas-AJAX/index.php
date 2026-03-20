<?php
$tituloPagina = "Praticando - AJAX";
$paginaAtual = "menu";

require_once __DIR__ . "/header.php";
?>

<div class="pagina-principal">
    <div class="titulo-pagina">
        <h1 class="text-center">Praticando - AJAX</h1>
    </div>

    <div class="row g-4">
        <div class="col-md-6">
            <div class="card card-menu shadow-sm">
                <div class="card-body d-flex flex-column">
                    <h2 class="h4 card-title">Exerc&iacute;cio 1</h2>
                    <p class="card-text">Verifica&ccedil;&atilde;o de e-mail com AJAX, PHP e arquivo texto, sem recarregar a p&aacute;gina.</p>
                    <a href="verificacao-email.php" class="btn btn-primary mt-auto">Abrir exerc&iacute;cio</a>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card card-menu shadow-sm">
                <div class="card-body d-flex flex-column">
                    <h2 class="h4 card-title">Exerc&iacute;cio 2</h2>
                    <p class="card-text">Cadastro de tarefas com AJAX, JSON em arquivo texto e tabela atualizada em tempo real.</p>
                    <a href="cadastro-tarefas.php" class="btn btn-primary mt-auto">Abrir exerc&iacute;cio</a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once __DIR__ . "/footer.php"; ?>
