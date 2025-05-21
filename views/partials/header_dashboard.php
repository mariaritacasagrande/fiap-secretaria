<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<!-- Bootstrap Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

<nav class="navbar navbar-light bg-light shadow-sm mb-4">
    <div class="container-fluid">
        <!-- Logo simples sem menu -->
        <a class="navbar-brand fw-bold" href="index.php?page=dashboard&action=index">FIAP Secretaria</a>

        <!-- Saudação e botão Sair -->
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
</nav>