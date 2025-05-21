<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Administrador - FIAP Secretaria</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<?php include BASE_PATH . '/views/partials/header.php'; ?>

<div class="container-fluid px-4">
    <h1 class="mb-4 fs-3">Editar Administrador</h1>

    <?php if (!empty($erro)) : ?>
        <div class="alert alert-danger"><?= htmlspecialchars($erro) ?></div>
    <?php endif; ?>

    <form method="POST" action="index.php?page=administradores&action=atualizar" class="bg-white p-4 rounded shadow-sm">
        <input type="hidden" name="id" value="<?= htmlspecialchars($admin['id']) ?>">

        <div class="mb-3">
            <label for="nome" class="form-label">Nome completo</label>
            <input type="text" name="nome" id="nome" class="form-control" required minlength="3"
                   value="<?= htmlspecialchars($admin['nome'] ?? '') ?>">
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">E-mail</label>
            <input type="email" name="email" id="email" class="form-control" required
                   value="<?= htmlspecialchars($admin['email'] ?? '') ?>">
        </div>

        <div class="mb-3">
            <label for="senha" class="form-label">Nova senha (opcional)</label>
            <input type="password" name="senha" id="senha" class="form-control">
            <div class="form-text">Preencha apenas se desejar alterar a senha. Mínimo de 8 caracteres.</div>
        </div>

        <div class="d-flex flex-wrap gap-2">
            <button type="submit" class="btn btn-success">Atualizar</button>
            <a href="index.php?page=administradores&action=listar" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
