<?php
declare(strict_types=1);

$animalSelecionado = "";

if (isset($_GET["animal"])) {
    $animalSelecionado = (string) $_GET["animal"];
}

$estilomacaco = "";
$estilotubarao = "";
$estilosuricato = "";
$estiloTartaruga = "";

if ($animalSelecionado === "macaco") {
    $estilomacaco = "border: 3px solid #ea580c;";
}

if ($animalSelecionado === "tubarao") {
    $estilotubarao = "border: 3px solid #7c3aed;";
}

if ($animalSelecionado === "suricato") {
    $estilosuricato = "border: 3px solid #0891b2;";
}

if ($animalSelecionado === "tartaruga") {
    $estiloTartaruga = "border: 3px solid #16a34a;";
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Animais</title>
  <style>
    * {
      box-sizing: border-box;
    }

    body {
      margin: 0;
      background: #ffffff;
      color: #000000;
      font-family: Arial, Helvetica, sans-serif;
      font-size: 16px;
      line-height: 1.5;
    }

    main {
      max-width: 980px;
      margin: 40px auto;
      padding: 0 16px;
    }

    h1,
    h2 {
      margin: 0 0 12px;
    }

    p {
      margin: 0 0 16px;
    }

    .galeria {
      display: flex;
      gap: 12px;
      flex-wrap: wrap;
      margin-bottom: 24px;
    }

    .animal {
      width: 220px;
      padding: 8px;
      border: 1px solid #999999;
      color: #000000;
      text-decoration: none;
    }

    .animal img {
      display: block;
      width: 100%;
      height: 140px;
      object-fit: cover;
      margin-bottom: 8px;
      border: 1px solid #999999;
    }

    a {
      color: #0000ee;
    }
  </style>
</head>
<body>
  <main>
    <h1>Animais</h1>
    <p>Clique em uma imagem para ver as informações do animal na mesma página.</p>

    <div class="galeria">
      <a class="animal" style="<?= htmlspecialchars($estilomacaco, ENT_QUOTES | ENT_SUBSTITUTE, "UTF-8") ?>" href="?animal=macaco">
        <img src="macaco.png" alt="Macaco arteiro">
        Macaco arteiro
      </a>

      <a class="animal" style="<?= htmlspecialchars($estilotubarao, ENT_QUOTES | ENT_SUBSTITUTE, "UTF-8") ?>" href="?animal=tubarao">
        <img src="tubarao.png" alt="Tubarão imponente">
        Tubarão imponente
      </a>

      <a class="animal" style="<?= htmlspecialchars($estilosuricato, ENT_QUOTES | ENT_SUBSTITUTE, "UTF-8") ?>" href="?animal=suricato">
        <img src="suricato.png" alt="Suricato vigilante">
        Suricato vigilante
      </a>

      <a class="animal" style="<?= htmlspecialchars($estiloTartaruga, ENT_QUOTES | ENT_SUBSTITUTE, "UTF-8") ?>" href="?animal=tartaruga">
        <img src="tartaruga.png" alt="Tartaruga tranquila">
        Tartaruga tranquila
      </a>
    </div>

    <?php if ($animalSelecionado === "macaco"): ?>
      <h2>Você clicou em: Macaco arteiro</h2>
      <p><a href="index.php">Limpar tudo</a></p>
      <p>O macaco é um verdadeiro especialista em bagunça organizada. Inteligente, curioso e cheio de energia, ele passa boa parte do tempo escalando, pulando e investigando tudo ao redor como se fosse o fiscal oficial da floresta.</p>
      <p>Muitas espécies vivem em grupos e usam sons, expressões e gestos para se comunicar. Além disso, têm grande habilidade com as mãos, o que ajuda na procura por alimento e também em pequenas travessuras que fazem parecer que a mata é o quintal particular deles.</p>
    <?php endif; ?>

    <?php if ($animalSelecionado === "tubarao"): ?>
      <h2>Você clicou em: Tubarão imponente</h2>
      <p><a href="index.php">Limpar tudo</a></p>
      <p>O tubarão é um dos grandes predadores dos oceanos e carrega aquela aparência de quem resolveu o problema da evolução no modo avançado. Com sentidos extremamente apurados, ele consegue perceber movimentos, vibrações e até sinais elétricos produzidos por outros animais.</p>
      <p>Apesar da fama de vilão dos mares, a maioria das espécies não representa risco constante para humanos. Na prática, o tubarão é muito mais importante para o equilíbrio do ecossistema marinho do que para estrelar filmes dramáticos com música de suspense.</p>
    <?php endif; ?>

    <?php if ($animalSelecionado === "suricato"): ?>
      <h2>Você clicou em: Suricato vigilante</h2>
      <p><a href="index.php">Limpar tudo</a></p>
      <p>O suricato é pequeno no tamanho, mas gigante na postura de quem leva a segurança do grupo muito a sério. Vivendo em bandos, ele costuma se revezar na função de vigia, ficando em pé para observar o ambiente enquanto os outros procuram alimento.</p>
      <p>Ágil e sociável, esse animal habita regiões secas e usa tocas para descanso e proteção. Sua expressão curiosa e o hábito de ficar ereto fazem parecer que ele está sempre julgando silenciosamente as escolhas de todo mundo ao redor.</p>
    <?php endif; ?>

    <?php if ($animalSelecionado === "tartaruga"): ?>
      <h2>Você clicou em: Tartaruga tranquila</h2>
      <p><a href="index.php">Limpar tudo</a></p>
      <p>A tartaruga é a prova viva de que não é preciso ter pressa para conquistar respeito. Conhecida pelo casco resistente e pelos movimentos calmos, ela transmite uma serenidade tão grande que parece estar sempre vivendo sem boleto e sem notificações.</p>
      <p>Existem espécies terrestres, de água doce e marinhas, cada uma adaptada ao seu ambiente. Mesmo com o jeito pacato, a tartaruga é resistente, longeva e muito importante para a natureza, mostrando que ir devagar ainda é melhor do que ir na direção errada.</p>
    <?php endif; ?>
  </main>
</body>
</html>