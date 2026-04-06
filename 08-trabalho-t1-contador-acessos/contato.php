<?php
declare(strict_types=1);

require_once __DIR__ . '/includes/layout.php';

registrarAcesso('contato.php');
renderizarCabecalho('contato.php', 'Contato');
?>
<section class="page-panel">
    <div class="page-panel__copy">
        <h1 class="page-panel__title">Contato</h1>
        <p>
            Esta página representa a área de contato pedida no trabalho. Os dados abaixo estão centralizados no arquivo
            de configuração para facilitar a personalização antes da entrega e do deploy na instância EC2.
        </p>
        <ul class="contact-list">
            <li><strong>Aluno:</strong> <?= e(ALUNO_NOME) ?></li>
            <li><strong>E-mail:</strong> <?= e(ALUNO_EMAIL) ?></li>
            <li><strong>Projeto:</strong> Contador de acessos com autenticação por sessão</li>
            <li><strong>Tecnologia:</strong> PHP com persistência em arquivos de texto</li>
        </ul>
        <p class="page-panel__note">Edite o arquivo de configuração para substituir os dados antes de publicar.</p>
    </div>

    <div class="page-panel__icon">
        <img src="<?= e(caminhoAsset(PAGINAS_TRABALHO['contato.php']['icone'])) ?>" alt="Ícone da página contato">
    </div>
</section>
<?php renderizarRodape(); ?>
