<?php
declare(strict_types=1);

require_once __DIR__ . '/08-trabalho-t1-contador-acessos/config.php';

$foto = './' . TRABALHO_PASTA . '/' . ltrim(ALUNO_FOTO, './');
$trabalhoUrl = './' . TRABALHO_PASTA . '/inicio.php';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Servidor Web da disciplina de VTPDWE2 2026/01</title>
    <link rel="stylesheet" href="./08-trabalho-t1-contador-acessos/assets/css/estilos.css">
</head>
<body class="landing-body">
    <div class="landing-shell">
        <h1 class="landing-title">Servidor Web da disciplina de VTPDWE2 2026/01</h1>

        <section class="landing-card">
            <div class="landing-left">
                <img class="landing-photo" src="<?= htmlspecialchars($foto, ENT_QUOTES, 'UTF-8') ?>" alt="Foto do aluno">
                <p class="landing-name"><?= htmlspecialchars(ALUNO_NOME, ENT_QUOTES, 'UTF-8') ?></p>
            </div>

            <div class="landing-right">
                <h2 class="landing-links-title">Links</h2>

                <div class="landing-links">
                    <a class="landing-link" href="<?= htmlspecialchars(BUSCA_CEP_URL, ENT_QUOTES, 'UTF-8') ?>">Praticando Busca CEP</a>
                    <a class="landing-link" href="<?= htmlspecialchars($trabalhoUrl, ENT_QUOTES, 'UTF-8') ?>">Trabalho 1 - Contador de Acessos</a>
                </div>
            </div>
        </section>
    </div>
</body>
</html>
