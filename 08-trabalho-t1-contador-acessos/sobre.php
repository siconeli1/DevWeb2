<?php
declare(strict_types=1);

require_once __DIR__ . '/includes/layout.php';

registrarAcesso('sobre.php');
renderizarCabecalho('sobre.php', 'Sobre');
?>
<section class="page-panel">
    <div class="page-panel__copy">
        <h1 class="page-panel__title">Sobre</h1>
        <p>
            Esta página apresenta o tema do trabalho em um layout inspirado no modelo mostrado pelo professor. A ideia
            é manter uma navegação simples, visual limpo e um conteúdo centralizado para valorizar o contador de
            acessos implementado em PHP.
        </p>
        <p>
            Todo o monitoramento de visitas é salvo em arquivos de texto, sem banco de dados e sem ferramentas
            externas de analytics, exatamente como o enunciado solicita. Cada abertura de página grava data, hora, IP
            e navegador utilizado.
        </p>
        <p>
            Também foi mantida a proposta de layout com menu superior, área principal destacada e rodapé com
            identificação do aluno, deixando a navegação parecida com a referência dos slides.
        </p>
        <p class="page-panel__note">Organização visual, simplicidade e persistência em arquivo.</p>
    </div>

    <div class="page-panel__icon">
        <img src="<?= e(caminhoAsset(PAGINAS_TRABALHO['sobre.php']['icone'])) ?>" alt="Ícone da página sobre">
    </div>
</section>
<?php renderizarRodape(); ?>
