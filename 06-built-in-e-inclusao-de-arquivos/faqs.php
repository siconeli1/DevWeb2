<?php
$tituloPagina = "FAQs";
$paginaAtual = "faqs";

require_once __DIR__ . "/header.php";
?>

<div class="pagina-conteudo">
    <div class="bg-light p-4 mb-4 rounded">
        <h1 class="text-center">FAQs</h1>
    </div>

    <img class="img-lorem img-thumbnail m-4 rounded float-end" src="../01-revisao-html-css/arquivos/Deep_fake_Tom_Cruise.jpeg" alt="Perguntas frequentes">
    <p>
        <strong>Como o site foi dividido?</strong> O cabeçalho e o rodapé ficam em arquivos próprios e são reutilizados nas demais páginas com include ou require.
    </p>
    <p>
        <strong>Qual a vantagem?</strong> A manutenção fica centralizada. Se um item do menu ou o rodapé mudar, basta alterar um único arquivo para refletir a mudança em todo o projeto.
    </p>
    <p>
        <strong>O formulário também usa essa estrutura?</strong> Sim. A página de contato e a página de destino reaproveitam o mesmo layout para seguir o padrão mostrado pelo professor.
    </p>
</div>

<?php require_once __DIR__ . "/footer.php"; ?>
