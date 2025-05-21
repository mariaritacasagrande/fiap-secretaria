<?php include BASE_PATH . '/views/partials/header.php'; ?>

<div class="container-fluid px-4">
    <h1 class="mb-4 fs-3">Editar Turma</h1>

    <?php if (!empty($erro)) : ?>
        <div class="alert alert-danger"><?= htmlspecialchars($erro) ?></div>
    <?php endif; ?>

    <form method="POST" action="index.php?page=turmas&action=atualizar" class="bg-white p-4 rounded shadow-sm">
        <input type="hidden" name="id" value="<?= htmlspecialchars($turma['id'] ?? '') ?>">

        <div class="mb-3">
            <label for="nome" class="form-label">Nome da Turma</label>
            <input type="text" name="nome" id="nome" class="form-control" value="<?= htmlspecialchars($turma['nome'] ?? '') ?>" required minlength="3">
        </div>

        <div class="mb-3">
            <label for="descricao" class="form-label">Descrição</label>
            <textarea name="descricao" id="descricao" class="form-control" rows="4" required><?= htmlspecialchars($turma['descricao'] ?? '') ?></textarea>
        </div>

        <div class="d-flex flex-wrap gap-2">
            <button type="submit" class="btn btn-success">Salvar Alterações</button>
            <a href="index.php?page=turmas&action=listar" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>

<?php include BASE_PATH . '/views/partials/footer.php'; ?>
