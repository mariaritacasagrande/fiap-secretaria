<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Alunos - FIAP Secretaria</title>
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
    <h1 class="mb-4 fs-3">Gerenciamento de Alunos</h1>

    <form method="GET" class="mb-4 row g-2">
        <input type="hidden" name="page" value="alunos">
        <input type="hidden" name="action" value="listar">
        <div class="col-md-4 col-sm-6">
            <input type="text" name="busca" class="form-control" placeholder="Buscar por nome..." value="<?= htmlspecialchars($_GET['busca'] ?? '') ?>">
        </div>
        <div class="col-auto">
            <button type="submit" class="btn btn-outline-primary">Buscar</button>
        </div>
    </form>

    <div class="mb-3">
        <a href="index.php?page=alunos&action=criar" class="btn btn-primary">Cadastrar Novo Aluno</a>
    </div>

    <?php if (!empty($alunos)) : ?>
        <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Nome</th>
                        <th>Data de Nascimento</th>
                        <th>CPF</th>
                        <th>E-mail</th>
                        <th class="text-center">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($alunos as $aluno): ?>
                        <tr>
                            <td><?= htmlspecialchars($aluno['nome']) ?></td>
                            <td><?= date('d/m/Y', strtotime($aluno['data_nascimento'])) ?></td>
                            <td><?= htmlspecialchars($aluno['cpf']) ?></td>
                            <td><?= htmlspecialchars($aluno['email']) ?></td>
                            <td class="text-center">
                                <div class="d-flex flex-wrap justify-content-center gap-2">
                                    <a href="index.php?page=alunos&action=editar&id=<?= $aluno['id'] ?>" class="btn btn-warning btn-sm">Editar</a>
                                    <a href="index.php?page=alunos&action=excluir&id=<?= $aluno['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Confirmar exclusão?')">Excluir</a>
                                    <a href="index.php?page=matriculas&action=listarPorAluno&id=<?= $aluno['id'] ?>" class="btn btn-info btn-sm">Ver Turmas</a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    <?php else : ?>
        <div class="alert alert-info">Nenhum aluno encontrado.</div>
    <?php endif; ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
