<?php
declare(strict_types=1);

require_once __DIR__ . '/../funcoes.php';

function renderizarCabecalho(string $paginaAtual, string $tituloPagina): void
{
    $mostrarSair = autenticado() && $paginaAtual === 'logs.php';
    ?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= e(TRABALHO_TITULO . ' | ' . $tituloPagina) ?></title>
    <link rel="stylesheet" href="<?= e(caminhoAsset('assets/css/estilos.css')) ?>">
</head>
<body class="app-body">
    <div class="app-shell">
        <header class="topbar">
            <div class="topbar__brand"><?= e(TRABALHO_TITULO . ' | ' . $tituloPagina) ?></div>
            <nav class="topbar__nav" aria-label="Menu principal">
                <?php foreach (PAGINAS_TRABALHO as $arquivo => $pagina): ?>
                    <a
                        class="topbar__link<?= $arquivo === $paginaAtual ? ' is-active' : '' ?>"
                        href="<?= e(rota($arquivo)) ?>">
                        <?= e((string) $pagina['menu']) ?>
                    </a>
                <?php endforeach; ?>

                <?php if ($mostrarSair): ?>
                    <a class="topbar__link topbar__link--danger" href="<?= e(rota('logout.php')) ?>">Sair do Acesso</a>
                <?php else: ?>
                    <a class="topbar__link topbar__link--danger<?= $paginaAtual === 'logs.php' ? ' is-active' : '' ?>" href="<?= e(rota('logs.php')) ?>">Logs de Acesso</a>
                <?php endif; ?>
            </nav>
        </header>
        <main class="page-main">
<?php
}

function renderizarRodape(): void
{
    ?>
        </main>
        <footer class="page-footer">
            <div><?= e(FOOTER_TITULO) ?></div>
            <div><?= e(ALUNO_NOME) ?></div>
            <div><?= e(ALUNO_EMAIL) ?></div>
        </footer>
    </div>
</body>
</html>
<?php
}
