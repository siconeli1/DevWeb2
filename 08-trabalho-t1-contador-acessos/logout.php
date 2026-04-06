<?php
declare(strict_types=1);

require_once __DIR__ . '/funcoes.php';

encerrarSessaoAcesso();
definirFlash('success', 'Sessão encerrada com sucesso.');

header('Location: ' . rota('logs.php'));
exit;
