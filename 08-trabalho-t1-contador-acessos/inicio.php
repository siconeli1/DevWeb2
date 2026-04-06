<?php
declare(strict_types=1);

require_once __DIR__ . '/includes/layout.php';

registrarAcesso('inicio.php');
renderizarCabecalho('inicio.php', 'Página Inicial');
?>
<section class="page-panel">
    <div class="page-panel__copy">
        <h1 class="page-panel__title">Página Inicial</h1>
        <p>
            Lorem, ipsum dolor sit amet consectetur adipisicing elit. Laborum ab autem voluptatem facilis recusandae
            dolorum explicabo commodi. Id pariatur distinctio quibusdam corporis facere. A debitis nam veniam? Eum,
            error.
        </p>
        <p>
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum, imperdieterat nec nisl? Quis placet
            ac quaerat, velit lorem nibh! maxime asperiores aliquam amet ad rerum ipsa, beatae hic suscipit
            reprehenderit rerum?
        </p>
        <p>
            Cum minus labore quam, officia et recusandae possimus molestias modi impedit voluptates itaque, nobis id
            earum? Aperiam laudantium consequatur recusandae aperiam. Culpa magni quasi sequi nihil ex fuga, architecto
            soluta.
        </p>
        <p class="page-panel__note">Molestiae natus possimus praesentium!</p>
    </div>

    <div class="page-panel__icon">
        <img src="<?= e(caminhoAsset(PAGINAS_TRABALHO['inicio.php']['icone'])) ?>" alt="Ícone da página inicial">
    </div>
</section>
<?php renderizarRodape(); ?>
