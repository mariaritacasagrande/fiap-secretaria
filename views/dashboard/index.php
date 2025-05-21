<?php
include BASE_PATH . '/views/partials/header_dashboard.php';
?>

<!-- Container para padding nas bordas -->
<div class="container py-4">
    <h1 class="mb-4 fs-3 text-center">Dashboard Geral</h1>

    <!-- Cards de acesso rápido lado a lado menores -->
    <div class="row row-cols-2 row-cols-md-4 g-3 mb-3 text-center">
        <div class="col">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-body py-3">
                    <div class="mb-2"><i class="bi bi-people fs-3 text-primary"></i></div>
                    <h6 class="card-title small">Alunos</h6>
                    <a href="index.php?page=alunos&action=listar" class="btn btn-outline-primary btn-sm">Ver</a>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-body py-3">
                    <div class="mb-2"><i class="bi bi-journal-text fs-3 text-success"></i></div>
                    <h6 class="card-title small">Turmas</h6>
                    <a href="index.php?page=turmas&action=listar" class="btn btn-outline-primary btn-sm">Ver</a>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-body py-3">
                    <div class="mb-2"><i class="bi bi-pencil-square fs-3 text-warning"></i></div>
                    <h6 class="card-title small">Matrículas</h6>
                    <a href="index.php?page=matriculas&action=listar" class="btn btn-outline-primary btn-sm">Ver</a>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-body py-3">
                    <div class="mb-2"><i class="bi bi-person-badge fs-3 text-danger"></i></div>
                    <h6 class="card-title small">Administradores</h6>
                    <a href="index.php?page=administradores&action=listar" class="btn btn-outline-primary btn-sm">Ver</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Formulário de busca abaixo dos cards -->
    <div class="mb-4">
        <form id="form-busca-aluno" class="d-flex" onsubmit="return false;">
            <input type="text" id="input-nome-aluno" class="form-control me-2" placeholder="Buscar aluno por nome...">
            <button type="submit" class="btn btn-primary">Buscar</button>
        </form>
    </div>

    <!-- Resultados AJAX -->
    <div id="resultado-busca-aluno" class="row g-3 mb-5"></div>
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
