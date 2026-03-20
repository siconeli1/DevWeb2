<?php
$tituloPagina = "FAQs";
$paginaAtual = "faqs";

require_once __DIR__ . "/header.php";
?>

<div class="pagina-conteudo">
    <div class="titulo-pagina">
        <h1 class="text-center">FAQs</h1>
    </div>

    <img class="img-lorem img-thumbnail m-4 rounded float-end" src="cachorro.png" alt="Cachorro">
    <p>
        <strong>Como as p&aacute;ginas foram montadas?</strong> Cada tela reaproveita os arquivos de cabe&ccedil;alho e rodap&eacute; com <code>require_once</code>, mantendo o mesmo visual em todas as se&ccedil;&otilde;es do site.
    </p>
    <p>
        <strong>Por que usar inclus&atilde;o de arquivos?</strong> Porque isso evita repeti&ccedil;&atilde;o de c&oacute;digo e facilita a manuten&ccedil;&atilde;o do layout, exatamente como foi pedido no exerc&iacute;cio da aula.
    </p>
    <>
        <strong>O formul&aacute;rio de contato tamb&eacute;m segue o mesmo padr&atilde;o?</strong> Sim. A tela de contato e a tela de destino usam a mesma estrutura visual para deixar a navega&ccedil;&atilde;o uniforme.
    <h1>
        CACHORRO
    </h1>
</div>

<?php require_once __DIR__ . "/footer.php"; ?>
