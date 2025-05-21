<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Turmas - FIAP Secretaria</title>
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
    <h1 class="mb-4 fs-3">Gerenciamento de Turmas</h1>

    <div class="mb-3">
        <a href="index.php?page=turmas&action=criar" class="btn btn-primary">Cadastrar Nova Turma</a>
    </div>

    <?php if (!empty($turmas)) : ?>
        <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Nome</th>
                        <th>Descrição</th>
                        <th>Alunos Matriculados</th>
                        <th class="text-center">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($turmas as $turma): ?>
                        <tr>
                            <td><?= htmlspecialchars($turma['nome']) ?></td>
                            <td><?= htmlspecialchars($turma['descricao']) ?></td>
                            <td><?= $turma['total_alunos'] ?></td>
                            <td class="text-center">
                                <div class="d-flex flex-wrap justify-content-center gap-2">
                                    <a href="index.php?page=turmas&action=editar&id=<?= $turma['id'] ?>" class="btn btn-warning btn-sm">Editar</a>
                                    <a href="index.php?page=turmas&action=excluir&id=<?= $turma['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Excluir esta turma?')">Excluir</a>
                                    <a href="index.php?page=matriculas&action=listar&turma_id=<?= $turma['id'] ?>" class="btn btn-info btn-sm">Ver Alunos</a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>

        <nav class="mt-4">
            <ul class="pagination justify-content-center">
                <?php for ($i = 1; $i <= $totalPaginas; $i++): ?>
                    <li class="page-item <?= ($i == ($_GET['pagina'] ?? 1)) ? 'active' : '' ?>">
                        <a class="page-link" href="index.php?page=turmas&action=listar&pagina=<?= $i ?>"><?= $i ?></a>
                    </li>
                <?php endfor; ?>
            </ul>
        </nav>

    <?php else : ?>
        <div class="alert alert-info">Nenhuma turma cadastrada.</div>
    <?php endif; ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
