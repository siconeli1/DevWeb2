<?php
declare(strict_types=1);

function obterCepFormulario(): string
{
    $cep = filter_input(INPUT_POST, 'cep', FILTER_UNSAFE_RAW);

    return is_string($cep) ? trim($cep) : '';
}

function normalizarCep(string $cep): string
{
    return preg_replace('/\D+/', '', $cep) ?? '';
}

function cepValido(string $cep): bool
{
    return strlen(normalizarCep($cep)) === 8;
}

function formatarCep(string $cep): string
{
    $cepNumerico = normalizarCep($cep);

    if (strlen($cepNumerico) !== 8) {
        return $cep;
    }

    return substr($cepNumerico, 0, 5) . '-' . substr($cepNumerico, 5, 3);
}

function valorCepCampo(string $cep): string
{
    if ($cep === '') {
        return '';
    }

    return cepValido($cep) ? formatarCep($cep) : $cep;
}

function escapar(?string $valor): string
{
    return htmlspecialchars(trim((string) $valor), ENT_QUOTES, 'UTF-8');
}

function valorOuNaoInformado(?string $valor): string
{
    $texto = trim((string) $valor);

    return $texto !== '' ? $texto : 'Não informado';
}

function mensagemDependenciasAusentes(): string
{
    return 'As dependências do Composer não foram encontradas. Execute "php composer.phar install" nesta pasta antes de abrir a página.';
}

function mensagemErroCep(array $erro): string
{
    $mensagem = trim((string) ($erro['message'] ?? ''));
    $detalhes = detalhesErroCep($erro);
    $detalhesTexto = implode(' ', $detalhes);

    if (str_contains($detalhesTexto, 'CEP não encontrado') || str_contains($detalhesTexto, 'CEP INVÁLIDO')) {
        return 'O CEP informado é inválido ou não foi encontrado.';
    }

    if ($mensagem !== '' && $mensagem !== 'Todos os serviços de CEP retornaram erro.') {
        return $mensagem;
    }

    return 'Não foi possível consultar o CEP no momento. Tente novamente em instantes.';
}

function detalhesErroCep(array $erro): array
{
    $detalhes = [];
    $errosProvedores = $erro['errors'] ?? [];

    if (!is_array($errosProvedores)) {
        return $detalhes;
    }

    foreach ($errosProvedores as $erroProvedor) {
        if (!is_array($erroProvedor)) {
            continue;
        }

        $provedor = trim((string) ($erroProvedor['provider'] ?? $erroProvedor['service'] ?? 'serviço'));
        $mensagem = normalizarMensagemErro((string) ($erroProvedor['message'] ?? 'Erro não informado.'));

        if ($mensagem === '') {
            continue;
        }

        $detalhes[] = ucfirst(str_replace('_', ' ', $provedor)) . ': ' . $mensagem;
    }

    return $detalhes;
}

function normalizarMensagemErro(string $mensagem): string
{
    $mensagem = trim($mensagem);

    if ($mensagem === '') {
        return '';
    }

    if (str_contains($mensagem, 'cURL error') || str_contains($mensagem, 'Failed to connect')) {
        return 'Serviço indisponível no momento.';
    }

    if (str_contains($mensagem, 'CEP não encontrado') || str_contains($mensagem, 'CEP INVÁLIDO')) {
        return $mensagem;
    }

    if (str_contains($mensagem, 'Não foi possível interpretar o XML de resposta.')) {
        return 'O serviço retornou uma resposta inesperada.';
    }

    return $mensagem;
}