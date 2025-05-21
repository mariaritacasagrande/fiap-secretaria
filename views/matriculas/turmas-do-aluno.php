<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Turmas do Aluno</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
<?php include BASE_PATH . '/views/partials/header.php'; ?>

    <h1 class="mb-4">Turmas em que o aluno está matriculado</h1>

    <?php if (!empty($turmas)) : ?>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nome da Turma</th>
                    <th>Descrição</th>
                    <th>Data da Matrícula</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($turmas as $turma): ?>
                    <tr>
                        <td><?= htmlspecialchars($turma['nome']) ?></td>
                        <td><?= htmlspecialchars($turma['descricao']) ?></td>
                        <td><?= date('d/m/Y', strtotime($turma['criado_em'])) ?></td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    <?php else : ?>
        <div class="alert alert-warning">Este aluno não está matriculado em nenhuma turma.</div>
    <?php endif; ?>

    <a href="index.php?page=alunos&action=listar" class="btn btn-secondary mt-3">Voltar à lista de alunos</a>

    <?php include BASE_PATH . '/views/partials/footer.php'; ?>
</body>
</html>
