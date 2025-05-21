<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Turma</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
    <h1 class="mb-4">Editar Turma</h1>

    <?php if (!empty($erro)) : ?>
        <div class="alert alert-danger"><?= htmlspecialchars($erro) ?></div>
    <?php endif; ?>

    <form action="index.php?page=turmas&action=atualizar" method="POST">
        <input type="hidden" name="id" value="<?= htmlspecialchars($turma['id']) ?>">

        <div class="mb-3">
            <label for="nome" class="form-label">Nome da Turma</label>
            <input type="text" class="form-control" id="nome" name="nome" required minlength="3" value="<?= htmlspecialchars($turma['nome']) ?>">
        </div>

        <div class="mb-3">
            <label for="descricao" class="form-label">Descrição</label>
            <textarea class="form-control" id="descricao" name="descricao" required rows="4"><?= htmlspecialchars($turma['descricao']) ?></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Salvar Alterações</button>
        <a href="index.php?page=turmas&action=listar" class="btn btn-secondary">Cancelar</a>
    </form>
</body>
</html>
