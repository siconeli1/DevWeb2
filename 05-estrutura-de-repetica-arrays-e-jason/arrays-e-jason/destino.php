<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<title>Destino</title>

<style>

body{
    font-family: Arial, Helvetica, sans-serif;
    background:#f5f5f5;
}

.container{
    width:900px;
    margin:40px auto;
}

h1{
    font-weight:300;
}

hr{
    border:0;
    border-top:1px solid #ccc;
}

.box{
    border:1px solid #7cb6a5;
    padding:15px;
    background:white;
}

ul{
    margin-top:10px;
}

pre{
    margin:0;
    white-space:pre-wrap;
    word-break:break-word;
}

</style>

</head>

<body>

<?php
$interessesRecebidos = filter_input(INPUT_POST, 'interesses', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
$interessesRecebidos = is_array($interessesRecebidos) ? $interessesRecebidos : [];

$interessesOrdenados = $interessesRecebidos;
sort($interessesOrdenados);
?>

<div class="container">

<h1>Destino</h1>

<hr>

<h3>Dados da requisição em JSON:</h3>

<div class="box">

<pre><?=
htmlspecialchars(
    json_encode($interessesRecebidos, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE),
    ENT_QUOTES,
    'UTF-8'
)
?></pre>

</div>

<h3>Interesses selecionados (em ordem alfabética)</h3>

<ul>

<?php

if(!empty($interessesOrdenados)){
    $totalInteresses = count($interessesOrdenados);

    for($indice = 0; $indice < $totalInteresses && $indice < 3; $indice++){
        echo '<li>' . htmlspecialchars($interessesOrdenados[$indice], ENT_QUOTES, 'UTF-8') . '</li>';
    }

    if($totalInteresses > 3){
        echo '<li>...</li>';
    }
} else {
    echo '<li>Nenhum interesse foi selecionado.</li>';
}

?>

</ul>

<br>

<a href="formulario.php">Voltar para o formulário</a>

</div>

</body>
</html>
