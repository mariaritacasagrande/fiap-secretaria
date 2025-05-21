<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Nova Matrícula - FIAP Secretaria</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<?php include BASE_PATH . '/views/partials/header.php'; ?>

<div class="container-fluid px-4">
    <h1 class="mb-4 fs-3">Nova Matrícula</h1>

    <?php if (!empty($erro)) : ?>
        <div class="alert alert-danger"><?= htmlspecialchars($erro) ?></div>
    <?php endif; ?>

    <form method="POST" action="index.php?page=matriculas&action=criar" class="bg-white p-4 rounded shadow-sm">

        <div class="mb-3">
            <label for="filtroAluno" class="form-label">Buscar Aluno</label>
            <input type="text" id="filtroAluno" class="form-control" placeholder="Digite para filtrar por nome">
        </div>

        <div class="mb-3">
            <label for="aluno_id" class="form-label">Aluno</label>
            <select name="aluno_id" id="aluno_id" class="form-select" required>
                <option value="">Selecione um aluno</option>
                <?php foreach ($alunos as $aluno): ?>
                    <?php
                        $nome = htmlspecialchars($aluno['nome'] ?? 'Aluno sem nome');
                        $email = isset($aluno['email']) ? ' (' . htmlspecialchars($aluno['email']) . ')' : '';
                    ?>
                    <option value="<?= $aluno['id'] ?>">
                        <?= $nome . $email ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="turma_id" class="form-label">Turma</label>
            <select name="turma_id" id="turma_id" class="form-select" required>
                <option value="">Selecione uma turma</option>
                <?php foreach ($turmas as $turma): ?>
                    <option value="<?= $turma['id'] ?>">
                        <?= htmlspecialchars($turma['nome']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="d-flex flex-wrap gap-2">
            <button type="submit" class="btn btn-success">Matricular</button>
            <a href="index.php?page=matriculas&action=listar" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>

<script>
    // Filtro de opções do select por nome
    document.getElementById('filtroAluno').addEventListener('keyup', function () {
        var filtro = this.value.toLowerCase();
        var select = document.getElementById('aluno_id');
        var options = select.getElementsByTagName('option');

        for (var i = 1; i < options.length; i++) {
            var texto = options[i].textContent.toLowerCase();
            options[i].style.display = texto.includes(filtro) ? '' : 'none';
        }
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
