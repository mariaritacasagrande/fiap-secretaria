<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<!-- Bootstrap Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

<nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm mb-4">
    <div class="container-fluid">
        <a class="navbar-brand fw-bold" href="index.php?page=alunos&action=listar">
            FIAP Secretaria
        </a>

        <button class="navbar-toggler border-0" type="button" id="menuToggle" aria-label="Toggle navigation">
            <i id="menuIcon" class="bi bi-list fs-2"></i>
        </button>

        <div class="collapse navbar-collapse" id="navbarAdmin">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="index.php?page=alunos&action=listar">Alunos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?page=turmas&action=listar">Turmas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?page=matriculas&action=criar">Nova Matrícula</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?page=administradores&action=listar">Administradores</a>
                </li>
            </ul>

            <div class="d-flex align-items-center flex-wrap gap-2">
                <?php if (!empty($_SESSION['admin_logado']) && !empty($_SESSION['admin_id']) && !empty($_SESSION['admin_nome'])): ?>
                    <a href="index.php?page=administradores&action=editar&id=<?= htmlspecialchars($_SESSION['admin_id']) ?>"
                       class="text-decoration-none text-muted small">
                        Olá, <strong><?= htmlspecialchars($_SESSION['admin_nome']) ?></strong>
                    </a>
                    <a href="index.php?page=auth&action=logout" class="btn btn-outline-danger btn-sm">Sair</a>
                <?php else: ?>
                    <a href="index.php?page=auth&action=login" class="btn btn-outline-primary btn-sm">Entrar</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</nav>

<script>
    const toggleBtn = document.getElementById('menuToggle');
    const icon = document.getElementById('menuIcon');
    const menu = document.getElementById('navbarAdmin');

    toggleBtn.addEventListener('click', () => {
        const isOpen = menu.classList.contains('show');
        if (isOpen) {
            menu.classList.remove('show');
            icon.className = 'bi bi-list fs-2';
        } else {
            menu.classList.add('show');
            icon.className = 'bi bi-x-lg fs-2';
        }
    });
</script>
