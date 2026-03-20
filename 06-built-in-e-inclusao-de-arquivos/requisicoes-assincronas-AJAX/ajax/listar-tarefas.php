<?php
$arquivoTarefas = dirname(__DIR__) . "/dados/tarefas.txt";

if (!file_exists($arquivoTarefas) || trim((string) file_get_contents($arquivoTarefas)) === "") {
    echo '<tr><td colspan="3" class="text-center">Nenhuma tarefa cadastrada.</td></tr>';
    exit;
}

$tarefas = json_decode((string) file_get_contents($arquivoTarefas), true);

if (!is_array($tarefas) || $tarefas === []) {
    echo '<tr><td colspan="3" class="text-center">Nenhuma tarefa cadastrada.</td></tr>';
    exit;
}

foreach ($tarefas as $tarefa) {
    $descricao = htmlspecialchars((string) ($tarefa["descricao"] ?? ""), ENT_QUOTES, "UTF-8");
    $prioridade = htmlspecialchars((string) ($tarefa["prioridade"] ?? ""), ENT_QUOTES, "UTF-8");
    $data = htmlspecialchars((string) ($tarefa["data"] ?? ""), ENT_QUOTES, "UTF-8");

    if ($prioridade === "Alta") {
        $classePrioridade = "bg-danger text-white";
    } elseif ($prioridade === "Média") {
        $classePrioridade = "bg-warning";
    } else {
        $classePrioridade = "bg-success text-white";
    }

    echo "<tr>";
    echo "<td>{$descricao}</td>";
    echo "<td><span class=\"badge {$classePrioridade} badge-prioridade\">{$prioridade}</span></td>";
    echo "<td>{$data}</td>";
    echo "</tr>";
}
