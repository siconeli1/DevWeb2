<?php
$tituloPagina = "Praticando - Cadastro de Tarefas";
$paginaAtual = "tarefas";
$mostrarCabecalhoAjax = true;
$rodapeProfessor = false;

require_once __DIR__ . "/header.php";
?>

<style>
    .pagina-cadastro-professor {
        max-width: 1050px;
        margin: 0 auto;
        min-height: 70vh;
        padding-top: 2.5rem;
    }

    .pagina-cadastro-professor h1 {
        font-size: 3.6rem;
        font-weight: 400;
        margin-bottom: 1rem;
    }

    .linha-separadora {
        border-bottom: 1px solid #dee2e6;
        margin-bottom: 1.5rem;
    }

    .formulario-professor label,
    .bloco-lista h2 {
        font-size: 1.2rem;
        font-weight: 400;
        margin-bottom: 0.6rem;
    }

    .grupo-radios .form-check {
        margin-bottom: 0.5rem;
    }

    .grupo-radios .form-check-label {
        font-size: 1.15rem;
    }

    .acoes-tarefas {
        margin-top: 1.5rem;
    }

    .feedback-tarefas-professor {
        min-height: 72px;
        margin-top: 1.5rem;
    }

    .bloco-lista {
        margin-top: 1.5rem;
    }

    @media (max-width: 991.98px) {
        .pagina-cadastro-professor h1 {
            font-size: 2.6rem;
        }
    }
</style>

<div class="pagina-cadastro-professor">
    <h1>Praticando - Cadastro de Tarefas</h1>
    <div class="linha-separadora"></div>

    <form id="form-tarefa" class="formulario-professor">
        <div class="row align-items-start">
            <div class="col-md-7 mb-4">
                <label for="descricao" class="form-label">Descri&ccedil;&atilde;o da tarefa</label>
                <input type="text" class="form-control form-control-lg" id="descricao" name="descricao" required>
            </div>

            <div class="col-md-5 mb-4">
                <label class="form-label d-block">Prioridade</label>

                <div class="grupo-radios">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="prioridade" id="prioridade-alta" value="alta" checked>
                        <label class="form-check-label" for="prioridade-alta">Alta</label>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="prioridade" id="prioridade-media" value="media">
                        <label class="form-check-label" for="prioridade-media">M&eacute;dia</label>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="prioridade" id="prioridade-baixa" value="baixa">
                        <label class="form-check-label" for="prioridade-baixa">Baixa</label>
                    </div>
                </div>
            </div>
        </div>

        <div class="acoes-tarefas d-flex gap-2 flex-wrap">
            <button type="submit" class="btn btn-primary btn-lg">Cadastrar</button>
            <button type="button" id="apagar-tarefas" class="btn btn-danger btn-lg">Apagar todas</button>
        </div>
    </form>

    <div id="feedback-tarefas" class="feedback-tarefas-professor"></div>

    <div class="linha-separadora mt-3"></div>

    <div class="bloco-lista">
        <h2>Tarefas cadastradas</h2>

        <div class="table-responsive">
            <table class="table table-striped table-bordered align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Descri&ccedil;&atilde;o</th>
                        <th>Prioridade</th>
                        <th>Data</th>
                    </tr>
                </thead>
                <tbody id="lista-tarefas">
                    <tr>
                        <td colspan="3" class="text-center">Carregando tarefas...</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    const formTarefa = document.getElementById("form-tarefa");
    const feedbackTarefas = document.getElementById("feedback-tarefas");
    const listaTarefas = document.getElementById("lista-tarefas");
    const botaoApagar = document.getElementById("apagar-tarefas");

    async function carregarTarefas() {
        try {
            const resposta = await fetch("ajax/listar-tarefas.php");
            listaTarefas.innerHTML = await resposta.text();
        } catch (error) {
            listaTarefas.innerHTML = '<tr><td colspan="3" class="text-center text-danger">N&atilde;o foi poss&iacute;vel carregar as tarefas.</td></tr>';
        }
    }

    formTarefa.addEventListener("submit", async function (event) {
        event.preventDefault();

        const dados = new FormData(formTarefa);

        try {
            const resposta = await fetch("ajax/cadastrar-tarefa.php", {
                method: "POST",
                body: dados
            });

            const retorno = await resposta.json();

            if (retorno.status === "sucesso") {
                feedbackTarefas.innerHTML = '<div class="alert alert-success mb-0">' + retorno.mensagem + '</div>';
                formTarefa.reset();
                document.getElementById("prioridade-alta").checked = true;
                await carregarTarefas();
                return;
            }

            feedbackTarefas.innerHTML = '<div class="alert alert-danger mb-0">' + retorno.mensagem + '</div>';
        } catch (error) {
            feedbackTarefas.innerHTML = '<div class="alert alert-danger mb-0">N&atilde;o foi poss&iacute;vel cadastrar a tarefa.</div>';
        }
    });

    botaoApagar.addEventListener("click", async function () {
        const confirmar = window.confirm("Deseja realmente apagar todas as tarefas?");

        if (!confirmar) {
            return;
        }

        try {
            const resposta = await fetch("ajax/apagar-tarefas.php", {
                method: "POST"
            });

            const retorno = await resposta.json();

            if (retorno.status === "sucesso") {
                feedbackTarefas.innerHTML = '<div class="alert alert-success mb-0">' + retorno.mensagem + '</div>';
                await carregarTarefas();
                return;
            }

            feedbackTarefas.innerHTML = '<div class="alert alert-danger mb-0">' + retorno.mensagem + '</div>';
        } catch (error) {
            feedbackTarefas.innerHTML = '<div class="alert alert-danger mb-0">N&atilde;o foi poss&iacute;vel apagar as tarefas.</div>';
        }
    });

    carregarTarefas();
</script>

<?php require_once __DIR__ . "/footer.php"; ?>
