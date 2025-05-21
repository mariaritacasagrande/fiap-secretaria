<?php
include BASE_PATH . '/views/partials/header_dashboard.php';
?>

<!-- Container para padding nas bordas -->
<div class="container py-4">
    <h1 class="mb-4 fs-3 text-center">Dashboard Geral</h1>

    <div class="mb-4">
        <form id="form-busca-aluno" class="d-flex" onsubmit="return false;">
            <input type="text" id="input-nome-aluno" class="form-control me-2" placeholder="Buscar aluno por nome...">
            <button type="submit" class="btn btn-primary">Buscar</button>
        </form>
    </div>

    <div id="resultado-busca-aluno" class="row g-3"></div>

    <div class="row g-4 justify-content-center">
        <div class="col-12 col-md-6">
            <div class="card shadow-sm h-100">
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title text-center">Alunos</h5>
                    <p class="card-text flex-grow-1 text-center">Total de alunos cadastrados.</p>
                    <a href="index.php?page=alunos&action=listar" class="btn btn-primary mt-auto align-self-center">Ver Alunos</a>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="card shadow-sm h-100">
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title text-center">Turmas</h5>
                    <p class="card-text flex-grow-1 text-center">Total de turmas criadas.</p>
                    <a href="index.php?page=turmas&action=listar" class="btn btn-primary mt-auto align-self-center">Ver Turmas</a>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="card shadow-sm h-100">
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title text-center">Matrículas</h5>
                    <p class="card-text flex-grow-1 text-center">Total de matrículas efetuadas.</p>
                    <a href="index.php?page=matriculas&action=listar" class="btn btn-primary mt-auto align-self-center">Ver Matrículas</a>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="card shadow-sm h-100">
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title text-center">Administradores</h5>
                    <p class="card-text flex-grow-1 text-center">Total de administradores ativos.</p>
                    <a href="index.php?page=administradores&action=listar" class="btn btn-primary mt-auto align-self-center">Ver Admins</a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('form-busca-aluno').addEventListener('submit', function () {
        const nome = document.getElementById('input-nome-aluno').value.trim();
        const container = document.getElementById('resultado-busca-aluno');
        container.innerHTML = '';

        if (nome.length < 2) {
            container.innerHTML = '<div class="alert alert-warning">Digite ao menos 2 caracteres.</div>';
            return;
        }

        fetch('ajax_buscar_aluno.php?nome=' + encodeURIComponent(nome))
            .then(res => res.json())
            .then(dados => {
                if (dados.length === 0) {
                    container.innerHTML = '<div class="alert alert-info">Nenhum aluno encontrado.</div>';
                    return;
                }
                dados.forEach(aluno => {
                    const col = document.createElement('div');
                    col.className = 'col-12 col-md-6 col-lg-4';
                    col.innerHTML = `
                        <div class="card h-100 shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title">${aluno.nome}</h5>
                                <p class="card-text mb-1"><strong>CPF:</strong> ${aluno.cpf}</p>
                                <p class="card-text"><strong>Email:</strong> ${aluno.email}</p>
                                <a href="index.php?page=alunos&action=editar&id=${aluno.id}" class="btn btn-outline-primary btn-sm">Ver Perfil</a>
                                <a href="index.php?page=matriculas&action=criar&aluno_id=${aluno.id}" class="btn btn-success btn-sm ms-2">Matricular</a>
                            </div>
                        </div>`;
                    container.appendChild(col);
                });
            })
            .catch(() => {
                container.innerHTML = '<div class="alert alert-danger">Erro ao buscar alunos.</div>';
            });
    });
</script>

<?php
include BASE_PATH . '/views/partials/footer.php';
