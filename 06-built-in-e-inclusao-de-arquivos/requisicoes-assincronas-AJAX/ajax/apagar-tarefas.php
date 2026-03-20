<?php
header("Content-Type: application/json; charset=UTF-8");

$diretorioDados = dirname(__DIR__) . "/dados";
$arquivoTarefas = $diretorioDados . "/tarefas.txt";

if (!is_dir($diretorioDados)) {
    mkdir($diretorioDados, 0777, true);
}

file_put_contents($arquivoTarefas, json_encode([], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

echo json_encode([
    "status" => "sucesso",
    "mensagem" => "Todas as tarefas foram apagadas."
]);
