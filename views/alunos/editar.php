<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Aluno - FIAP Secretaria</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<?php include BASE_PATH . '/views/partials/header.php'; ?>

<div class="container-fluid px-4">
    <h1 class="mb-4 fs-3">Editar Aluno</h1>

    <?php if (!empty($erro)) : ?>
        <div class="alert alert-danger"><?= htmlspecialchars($erro) ?></div>
    <?php endif; ?>

    <form method="POST" action="index.php?page=alunos&action=atualizar" class="bg-white p-4 rounded shadow-sm">
        <input type="hidden" name="id" value="<?= $aluno['id'] ?>">

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="nome" class="form-label">Nome completo</label>
                <input type="text" class="form-control" id="nome" name="nome" required minlength="3" value="<?= htmlspecialchars($aluno['nome']) ?>">
            </div>
            <div class="col-md-3">
                <label for="data_nascimento" class="form-label">Data de nascimento</label>
                <input type="date" class="form-control" id="data_nascimento" name="data_nascimento" required value="<?= $aluno['data_nascimento'] ?>">
            </div>
            <div class="col-md-3">
                <label for="cpf" class="form-label">CPF</label>
                <input type="text" class="form-control" id="cpf" name="cpf" required value="<?= htmlspecialchars($aluno['cpf']) ?>">
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="email" class="form-label">E-mail</label>
                <input type="email" class="form-control" id="email" name="email" required value="<?= htmlspecialchars($aluno['email']) ?>">
            </div>
            <div class="col-md-6">
                <label for="senha" class="form-label">Nova Senha (opcional)</label>
                <input type="password" class="form-control" id="senha" name="senha">
                <div class="form-text">
                    Preencha apenas se desejar alterar a senha. Deve conter no mínimo 8 caracteres, incluindo letra maiúscula, minúscula, número e símbolo.
                </div>
            </div>
        </div>

        <div class="d-flex flex-wrap gap-2">
            <button type="submit" class="btn btn-success">Atualizar</button>
            <a href="index.php?page=alunos&action=listar" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>
<?php include BASE_PATH . '/views/partials/footer.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
