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
        <div class="d-flex align-items-center gap-2 ms-auto">
            <?php if (!empty($_SESSION['admin_logado']) && !empty($_SESSION['admin_id']) && !empty($_SESSION['admin_nome'])): ?>
                <span class="text-muted small">Olá, <strong><?= htmlspecialchars($_SESSION['admin_nome']) ?></strong></span>
                <a href="index.php?page=auth&action=logout" class="btn btn-outline-danger btn-sm">Sair</a>
            <?php endif; ?>
        </div>
    </div>
</nav>
