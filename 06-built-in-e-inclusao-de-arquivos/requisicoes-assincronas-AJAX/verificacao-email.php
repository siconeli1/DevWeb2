<?php
$tituloPagina = "Praticando - Verificação de email";
$paginaAtual = "email";

require_once __DIR__ . "/header.php";
?>

<div class="pagina-exercicio">
    <div class="titulo-pagina">
        <h1 class="text-center">Praticando - Verifica&ccedil;&atilde;o de email</h1>
    </div>

    <a href="index.php" class="voltar-menu">Voltar ao menu</a>

    <div class="row justify-content-center">
        <div class="col-lg-6">
            <form id="form-email" class="row g-3">
                <div class="col-12">
                    <label for="email" class="form-label">E-mail</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Digite seu email" required>
                </div>

                <div class="col-12">
                    <button type="submit" class="btn btn-primary">Verificar</button>
                </div>
            </form>

            <div id="feedback-email" class="feedback-ajax mt-4"></div>
        </div>
    </div>
</div>

<script>
    const formEmail = document.getElementById("form-email");
    const inputEmail = document.getElementById("email");
    const feedbackEmail = document.getElementById("feedback-email");

    formEmail.addEventListener("submit", async function (event) {
        event.preventDefault();

        const email = inputEmail.value.trim();

        if (!inputEmail.checkValidity()) {
            inputEmail.classList.add("is-invalid");
            inputEmail.classList.remove("is-valid");
            feedbackEmail.innerHTML = '<div class="alert alert-danger mb-0">Informe um e-mail em formato v&aacute;lido.</div>';
            return;
        }

        const dados = new FormData();
        dados.append("email", email);

        try {
            const resposta = await fetch("ajax/verificar-email.php", {
                method: "POST",
                body: dados
            });

            const retorno = await resposta.json();

            inputEmail.classList.remove("is-valid", "is-invalid");

            if (retorno.status === "sucesso") {
                inputEmail.classList.add("is-valid");
                feedbackEmail.innerHTML = '<div class="alert alert-success mb-0">' + retorno.mensagem + '</div>';
                setTimeout(function () {
                    formEmail.reset();
                    inputEmail.classList.remove("is-valid", "is-invalid");
                    inputEmail.focus();
                }, 300);
                return;
            }

            inputEmail.classList.add("is-invalid");
            feedbackEmail.innerHTML = '<div class="alert alert-danger mb-0">' + retorno.mensagem + '</div>';
        } catch (error) {
            inputEmail.classList.remove("is-valid");
            inputEmail.classList.add("is-invalid");
            feedbackEmail.innerHTML = '<div class="alert alert-danger mb-0">N&atilde;o foi poss&iacute;vel verificar o e-mail agora.</div>';
        }
    });
</script>

<?php require_once __DIR__ . "/footer.php"; ?>
