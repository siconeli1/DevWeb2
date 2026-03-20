<?php
header("Content-Type: application/json; charset=UTF-8");

$emailRecebido = trim((string) filter_input(INPUT_POST, "email", FILTER_UNSAFE_RAW));
$email = filter_var($emailRecebido, FILTER_SANITIZE_EMAIL);
$emailNormalizado = mb_strtolower($email, "UTF-8");

if ($emailNormalizado === "" || !filter_var($emailNormalizado, FILTER_VALIDATE_EMAIL)) {
    echo json_encode([
        "status" => "erro",
        "mensagem" => "Informe um e-mail em formato v&aacute;lido."
    ]);
    exit;
}

$diretorioDados = dirname(__DIR__) . "/dados";
$arquivoEmails = $diretorioDados . "/emails.txt";

if (!is_dir($diretorioDados)) {
    mkdir($diretorioDados, 0777, true);
}

if (!file_exists($arquivoEmails)) {
    file_put_contents($arquivoEmails, "");
}

$emailsCadastrados = file($arquivoEmails, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
$emailsNormalizados = array_map(
    static fn(string $item): string => mb_strtolower(trim($item), "UTF-8"),
    $emailsCadastrados
);

if (in_array($emailNormalizado, $emailsNormalizados, true)) {
    echo json_encode([
        "status" => "erro",
        "mensagem" => "E-mail j&aacute; cadastrado no arquivo."
    ]);
    exit;
}

file_put_contents($arquivoEmails, $emailNormalizado . PHP_EOL, FILE_APPEND);

echo json_encode([
    "status" => "sucesso",
    "mensagem" => "E-mail cadastrado com sucesso."
]);
