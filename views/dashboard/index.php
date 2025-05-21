<?php
include BASE_PATH . '/views/partials/header_dashboard.php';
?>

<!-- Container para padding nas bordas -->
<div class="container py-4">
    <h1 class="mb-4 fs-3 text-center">Dashboard Geral</h1>

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

<?php
include BASE_PATH . '/views/partials/footer.php';
