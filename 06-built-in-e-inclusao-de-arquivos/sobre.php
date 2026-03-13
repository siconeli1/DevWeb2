<?php
$tituloPagina = "Sobre";
$paginaAtual = "sobre";

require_once __DIR__ . "/header.php";
?>

<div class="pagina-conteudo">
    <div class="bg-light p-4 mb-4 rounded">
        <h1 class="text-center">Sobre</h1>
    </div>

    <img class="img-lorem img-thumbnail m-4 rounded float-end" src="../01-revisao-html-css/arquivos/360_F_440137850_sBJOKpItVGgxB2XgCY4pxJECaU3QTEXC.jpg" alt="Tecnologia">
    <p>
        Esta página apresenta um exemplo de conteúdo institucional montado a partir do mesmo layout-base do professor. A proposta é manter cabeçalho, navegação e rodapé em arquivos separados, deixando o conteúdo central de cada página independente e mais fácil de atualizar.
    </p>
    <p>
        Ao modularizar a estrutura com PHP, alterações visuais passam a ser feitas uma única vez e refletidas em todo o site. Esse é exatamente o objetivo do exercício da aula: praticar inclusão de arquivos com uma estrutura simples, organizada e reutilizável.
    </p>
</div>

<?php require_once __DIR__ . "/footer.php"; ?>
