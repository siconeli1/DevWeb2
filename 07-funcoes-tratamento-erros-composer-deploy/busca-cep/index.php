<?php
declare(strict_types=1);

use Claudsonm\CepPromise\CepPromise;
use Claudsonm\CepPromise\Exceptions\CepPromiseException;

require_once __DIR__ . '/funcoes.php';

$cepInformado = obterCepFormulario();
$cepCampo = valorCepCampo($cepInformado);
$mensagemErro = '';
$detalhesErro = [];
$endereco = null;
$arquivoAutoload = __DIR__ . '/vendor/autoload.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($cepInformado === '') {
        $mensagemErro = 'Informe um CEP antes de enviar o formulário.';
    } elseif (!cepValido($cepInformado)) {
        $mensagemErro = 'Digite um CEP válido com 8 números.';
    } elseif (!is_file($arquivoAutoload)) {
        $mensagemErro = mensagemDependenciasAusentes();
    } else {
        require_once $arquivoAutoload;

        try {
            $endereco = CepPromise::fetch(normalizarCep($cepInformado))->toArray();
            $cepCampo = formatarCep((string) ($endereco['zipCode'] ?? normalizarCep($cepInformado)));
        } catch (CepPromiseException $exception) {
            $erro = $exception->toArray();
            $mensagemErro = mensagemErroCep($erro);
            $detalhesErro = detalhesErroCep($erro);
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Busca de CEP</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            background: #f5f5f5;
        }

        .container {
            width: min(900px, calc(100% - 32px));
            margin: 40px auto;
        }

        h1 {
            font-weight: 300;
            margin-bottom: 0;
        }

        hr {
            border: 0;
            border-top: 1px solid #ccc;
            margin: 18px 0 24px;
        }

        p {
            line-height: 1.5;
        }

        .campo {
            margin-bottom: 18px;
        }

        label {
            display: block;
            margin-bottom: 6px;
        }

        input[type="text"] {
            width: min(320px, 100%);
            padding: 10px 12px;
            border: 1px solid #b9b9b9;
            border-radius: 4px;
            font-size: 15px;
        }

        .botoes {
            margin-top: 20px;
        }

        .enviar,
        .limpar {
            border: none;
            padding: 10px 20px;
            font-size: 14px;
            border-radius: 4px;
            cursor: pointer;
        }

        .enviar {
            background: #2f6edb;
            color: white;
        }

        .limpar {
            background: #f2b705;
            color: #111;
        }

        .box,
        .erro {
            padding: 15px;
            background: white;
        }

        .box {
            border: 1px solid #7cb6a5;
        }

        .erro {
            border: 1px solid #d35454;
        }

        .resultado {
            margin-top: 28px;
        }

        .resultado p,
        .erro p {
            margin: 10px 0;
        }

        .erro ul {
            margin: 10px 0 0;
            padding-left: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Busca de CEP</h1>

        <hr>

        <p>Digite um CEP para consultar o endereço usando a biblioteca instalada via Composer.</p>

        <form action="" method="POST" accept-charset="UTF-8" autocomplete="off">
            <div class="campo">
                <label for="cep">CEP</label>
                <input
                    type="text"
                    id="cep"
                    name="cep"
                    placeholder="00000-000"
                    value="<?= escapar($cepCampo) ?>"
                    maxlength="10">
            </div>

            <div class="botoes">
                <button class="enviar" type="submit">Enviar</button>
                <button class="limpar" type="reset">Limpar</button>
            </div>
        </form>

        <?php if ($mensagemErro !== ''): ?>
            <div class="resultado">
                <h3>Erro na consulta</h3>

                <div class="erro">
                    <p><?= escapar($mensagemErro) ?></p>

                    <?php if ($detalhesErro !== []): ?>
                        <ul>
                            <?php foreach ($detalhesErro as $detalhe): ?>
                                <li><?= escapar($detalhe) ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </div>
            </div>
        <?php endif; ?>

        <?php if (is_array($endereco)): ?>
            <div class="resultado">
                <h3>Endereço encontrado</h3>

                <div class="box">
                    <p><strong>CEP:</strong> <?= escapar(formatarCep((string) ($endereco['zipCode'] ?? ''))) ?></p>
                    <p><strong>Logradouro:</strong> <?= escapar(valorOuNaoInformado($endereco['street'] ?? '')) ?></p>
                    <p><strong>Bairro:</strong> <?= escapar(valorOuNaoInformado($endereco['district'] ?? '')) ?></p>
                    <p><strong>Cidade:</strong> <?= escapar(valorOuNaoInformado($endereco['city'] ?? '')) ?></p>
                    <p><strong>Estado:</strong> <?= escapar(valorOuNaoInformado($endereco['state'] ?? '')) ?></p>
                </div>
            </div>
        <?php endif; ?>
    </div>
</body>

</html>