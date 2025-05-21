<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Administradores - FIAP Secretaria</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<?php include BASE_PATH . '/views/partials/header.php'; ?>

<div class="container-fluid px-4">
    <h1 class="mb-4 fs-3">Administradores</h1>

    <?php if (!empty($erro)) : ?>
        <div class="alert alert-danger"><?= htmlspecialchars($erro) ?></div>
    <?php endif; ?>

    <a href="index.php?page=administradores&action=criar" class="btn btn-success mb-3">Novo Administrador</a>

    <div class="table-responsive">
        <table class="table table-bordered align-middle">
            <thead class="table-light">
                <tr>
                    <th>Nome</th>
                    <th>Email</th>
                    <th class="text-center">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($administradores)) : ?>
                    <?php foreach ($administradores as $admin) : ?>
                        <tr>
                            <td>
                                <a href="index.php?page=administradores&action=editar&id=<?= htmlspecialchars($admin['id']) ?>">
                                    <?= htmlspecialchars($admin['nome']) ?>
                                </a>
                            </td>
                            <td><?= htmlspecialchars($admin['email']) ?></td>
                            <td class="text-center">
                                <a href="index.php?page=administradores&action=editar&id=<?= htmlspecialchars($admin['id']) ?>" class="btn btn-sm btn-primary">Editar</a>
                                
                                <?php if (count($administradores) > 1 && $admin['id'] != 1): ?>
                                    <a href="index.php?page=administradores&action=excluir&id=<?= htmlspecialchars($admin['id']) ?>"
                                       class="btn btn-sm btn-danger"
                                       onclick="return confirm('Tem certeza que deseja excluir este administrador?')">Excluir</a>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="3" class="text-center">Nenhum administrador cadastrado.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
