<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<title>Formulário</title>

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

.interesses{
    display:flex;
    gap:60px;
    margin-top:20px;
}

.coluna{
    display:flex;
    flex-direction:column;
}

label{
    margin-bottom:6px;
}

.botoes{
    margin-top:20px;
}

.enviar{
    background:#2f6edb;
    color:white;
    border:none;
    padding:10px 20px;
    font-size:14px;
    border-radius:4px;
    cursor:pointer;
}

.limpar{
    background:#f2b705;
    border:none;
    padding:10px 20px;
    font-size:14px;
    border-radius:4px;
    cursor:pointer;
}

</style>

</head>

<body>

<div class="container">

<h1>Formulário</h1>

<hr>

<p>Escolha alguns interesses:</p>

<form action="destino.php" method="POST" accept-charset="UTF-8">

<div class="interesses">

<div class="coluna">

<label><input type="checkbox" name="interesses[]" value="Esportes"> Esportes</label>
<label><input type="checkbox" name="interesses[]" value="Futebol"> Futebol</label>
<label><input type="checkbox" name="interesses[]" value="Basquete"> Basquete</label>
<label><input type="checkbox" name="interesses[]" value="Tênis"> Tênis</label>
<label><input type="checkbox" name="interesses[]" value="Taekwondo"> Taekwondo</label>
<label><input type="checkbox" name="interesses[]" value="Tecnologia"> Tecnologia</label>

</div>

<div class="coluna">

<label><input type="checkbox" name="interesses[]" value="Smartphones"> Smartphones</label>
<label><input type="checkbox" name="interesses[]" value="Computadores e hardware"> Computadores e hardware</label>
<label><input type="checkbox" name="interesses[]" value="Desktop gamers"> Desktop gamers</label>
<label><input type="checkbox" name="interesses[]" value="Notebooks"> Notebooks</label>
<label><input type="checkbox" name="interesses[]" value="Veículos"> Veículos</label>
<label><input type="checkbox" name="interesses[]" value="Escritório"> Escritório</label>

</div>

<div class="coluna">

<label><input type="checkbox" name="interesses[]" value="Vestuário"> Vestuário</label>
<label><input type="checkbox" name="interesses[]" value="Perfumes"> Perfumes</label>
<label><input type="checkbox" name="interesses[]" value="Economia"> Economia</label>
<label><input type="checkbox" name="interesses[]" value="Comidas"> Comidas</label>
<label><input type="checkbox" name="interesses[]" value="Bebidas"> Bebidas</label>
<label><input type="checkbox" name="interesses[]" value="Imóveis"> Imóveis</label>

</div>

<div class="coluna">

<label><input type="checkbox" name="interesses[]" value="Calçados"> Calçados</label>
<label><input type="checkbox" name="interesses[]" value="Hotéis"> Hotéis</label>
<label><input type="checkbox" name="interesses[]" value="Pousadas"> Pousadas</label>
<label><input type="checkbox" name="interesses[]" value="Cinema"> Cinema</label>
<label><input type="checkbox" name="interesses[]" value="Filmes"> Filmes</label>
<label><input type="checkbox" name="interesses[]" value="Séries"> Séries</label>

</div>

</div>

<div class="botoes">
<button class="enviar" type="submit">Enviar</button>
<button class="limpar" type="reset">Limpar</button>
</div>

</form>

</div>

</body>
</html>
