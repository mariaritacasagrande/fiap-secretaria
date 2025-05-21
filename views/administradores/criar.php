<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Novo Administrador - FIAP Secretaria</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<?php include BASE_PATH . '/views/partials/header.php'; ?>

<div class="container-fluid px-4">
    <h1 class="mb-4 fs-3">Novo Administrador</h1>

    <?php if (!empty($erro)) : ?>
        <div class="alert alert-danger"><?= htmlspecialchars($erro) ?></div>
    <?php endif; ?>

    <form method="POST" action="index.php?page=administradores&action=criar" class="bg-white p-4 rounded shadow-sm">

        <div class="mb-3">
            <label for="nome" class="form-label">Nome completo</label>
            <input type="text" name="nome" id="nome" class="form-control" required minlength="3"
                   value="<?= htmlspecialchars($_POST['nome'] ?? '') ?>">
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">E-mail</label>
            <input type="email" name="email" id="email" class="form-control" required
                   value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
        </div>

        <div class="mb-3">
            <label for="senha" class="form-label">Senha</label>
            <input type="password" name="senha" id="senha" class="form-control" required minlength="8">
            <div class="form-text">
                A senha deve conter no mínimo 8 caracteres, com pelo menos uma letra maiúscula, uma letra minúscula e um número.
            </div>
        </div>

        <div class="d-flex flex-wrap gap-2">
            <button type="submit" class="btn btn-success">Salvar</button>
            <a href="index.php?page=administradores&action=listar" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>
<?php include BASE_PATH . '/views/partials/footer.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
