<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Administradores - FIAP Secretaria</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .table-responsive {
            overflow-x: auto;
        }
        th, td {
            white-space: nowrap;
        }
    </style>
</head>
<body class="bg-light">
<?php include BASE_PATH . '/views/partials/header.php'; ?>

<div class="container-fluid px-4">
    <h1 class="fs-3 mb-4">Gerenciamento de Administradores</h1>

    <?php if (!empty($erro)) : ?>
        <div class="alert alert-danger"><?= htmlspecialchars($erro) ?></div>
    <?php endif; ?>

    <div class="mb-3">
        <a href="index.php?page=administradores&action=criar" class="btn btn-primary">Cadastrar Novo Administrador</a>
    </div>

    <?php if (!empty($admins)) : ?>
        <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Nome</th>
                        <th>Email</th>
                        <th>Criado em</th>
                        <th class="text-center">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($admins as $admin): ?>
                        <tr>
                            <td><?= htmlspecialchars($admin['nome']) ?></td>
                            <td><?= htmlspecialchars($admin['email']) ?></td>
                            <td><?= date('d/m/Y H:i', strtotime($admin['criado_em'])) ?></td>
                            <td class="text-center">
                                <div class="d-flex flex-wrap justify-content-center gap-2">
                                    <a href="index.php?page=administradores&action=editar&id=<?= $admin['id'] ?>" class="btn btn-warning btn-sm">Editar</a>
                                    <?php if ($admin['id'] != $_SESSION['admin_id']): ?>
                                        <a href="index.php?page=administradores&action=excluir&id=<?= $admin['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Deseja realmente excluir este administrador?')">Excluir</a>
                                    <?php endif; ?>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    <?php else : ?>
        <div class="alert alert-info">Nenhum administrador cadastrado.</div>
    <?php endif; ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
