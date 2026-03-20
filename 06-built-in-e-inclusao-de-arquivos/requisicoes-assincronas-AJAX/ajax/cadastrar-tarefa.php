<?php
header("Content-Type: application/json; charset=UTF-8");
date_default_timezone_set("America/Sao_Paulo");

$descricaoRecebida = trim((string) filter_input(INPUT_POST, "descricao", FILTER_UNSAFE_RAW));
$prioridadeRecebida = trim((string) filter_input(INPUT_POST, "prioridade", FILTER_UNSAFE_RAW));

$descricao = htmlspecialchars(strip_tags($descricaoRecebida), ENT_QUOTES, "UTF-8");
$prioridade = htmlspecialchars(strip_tags($prioridadeRecebida), ENT_QUOTES, "UTF-8");
$prioridadesPermitidas = ["alta", "media", "baixa"];

if ($prioridade === "alta") {
    $prioridadeExibicao = "Alta";
} elseif ($prioridade === "media") {
    $prioridadeExibicao = "Média";
} else {
    $prioridadeExibicao = "Baixa";
}

if ($descricao === "" || !in_array($prioridade, $prioridadesPermitidas, true)) {
    echo json_encode([
        "status" => "erro",
        "mensagem" => "Informe a descri&ccedil;&atilde;o da tarefa e uma prioridade v&aacute;lida."
    ]);
    exit;
}

$diretorioDados = dirname(__DIR__) . "/dados";
$arquivoTarefas = $diretorioDados . "/tarefas.txt";

if (!is_dir($diretorioDados)) {
    mkdir($diretorioDados, 0777, true);
}

if (!file_exists($arquivoTarefas) || trim((string) file_get_contents($arquivoTarefas)) === "") {
    file_put_contents($arquivoTarefas, json_encode([], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
}

$conteudoAtual = (string) file_get_contents($arquivoTarefas);
$tarefas = json_decode($conteudoAtual, true);

if (!is_array($tarefas)) {
    $tarefas = [];
}

$tarefas[] = [
    "descricao" => $descricao,
    "prioridade" => $prioridadeExibicao,
    "data" => date("d/m/Y H:i:s")
];

file_put_contents($arquivoTarefas, json_encode($tarefas, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

echo json_encode([
    "status" => "sucesso",
    "mensagem" => "Tarefa cadastrada com sucesso."
]);
