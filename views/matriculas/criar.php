<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Matricular Aluno</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
<?php include BASE_PATH . '/views/partials/header.php'; ?>

    <h1 class="mb-4">Realizar Matrícula</h1>

    <?php if (!empty($erro)) : ?>
        <div class="alert alert-danger"><?= htmlspecialchars($erro) ?></div>
    <?php endif; ?>

    <form action="index.php?page=matriculas&action=salvar" method="POST">
        <div class="mb-3">
            <label for="aluno_id" class="form-label">Selecione o Aluno</label>
            <select class="form-select" id="aluno_id" name="aluno_id" required>
                <option value="">-- Escolha um aluno --</option>
                <?php foreach ($alunos as $aluno): ?>
                    <option value="<?= $aluno['id'] ?>"><?= htmlspecialchars($aluno['nome']) ?></option>
                <?php endforeach ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="turma_id" class="form-label">Selecione a Turma</label>
            <select class="form-select" id="turma_id" name="turma_id" required>
                <option value="">-- Escolha uma turma --</option>
                <?php foreach ($turmas as $turma): ?>
                    <option value="<?= $turma['id'] ?>"><?= htmlspecialchars($turma['nome']) ?></option>
                <?php endforeach ?>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Matricular</button>
        <a href="index.php?page=alunos&action=listar" class="btn btn-secondary">Voltar</a>
    </form>
</body>
</html>
