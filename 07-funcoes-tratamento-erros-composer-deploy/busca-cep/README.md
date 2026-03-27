# Busca de CEP com Composer

Este praticando segue o que aparece nas aulas 7a a 7e:

- uso de funcoes para evitar repeticao de codigo;
- tratamento de erros com `try...catch`;
- uso do Composer com a biblioteca `claudsonm/cep-promise-php`;
- deploy manual da mesma atividade em uma instancia EC2.

## O que foi implementado

- formulario com um unico campo de CEP;
- envio `POST` para a propria pagina;
- formatacao do CEP no back-end;
- exibicao amigavel do endereco encontrado;
- mensagens de erro sem mostrar pilha tecnica para o usuario.

## Como executar localmente

1. Abra esta pasta no terminal.
2. Se a pasta `vendor` nao existir, execute `php composer.phar install`.
3. Publique a pasta no Apache do XAMPP ou use o servidor PHP embutido.
4. Acesse `index.php` pelo navegador.

## O que fazer no deploy da EC2

Assumindo que sua instancia ja tenha Apache/Nginx com PHP configurado:

1. Envie os arquivos do projeto com FileZilla ou outro cliente SFTP.
2. Nao envie a pasta `vendor/`.
3. Garanta que `composer.json` e `composer.lock` estejam no servidor.
4. Conecte na EC2 via SSH.
5. Instale os pacotes basicos:

```bash
sudo apt update
sudo apt install php-cli unzip curl
```

6. Instale o Composer na instancia seguindo a documentacao oficial:

- https://getcomposer.org/download/
- https://getcomposer.org/doc/00-intro.md

7. Entre na pasta do projeto e execute:

```bash
composer install
```

8. Verifique se a pasta `vendor/` foi criada.
9. Teste a pagina no navegador.

## Observacao importante

O professor reforca que `vendor/` nao sobe para producao. Ela deve ser gerada no servidor com `composer install`.
