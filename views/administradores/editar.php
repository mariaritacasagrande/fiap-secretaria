<?php include BASE_PATH . '/views/partials/header.php'; ?>

<div class="container-fluid px-4">
    <h1 class="mb-4 fs-3">Editar Administrador</h1>

    <form method="POST" action="index.php?page=administradores&action=atualizar" class="bg-white p-4 rounded shadow-sm">
        <input type="hidden" name="id" value="<?= htmlspecialchars($administrador['id']) ?>">

        <div class="mb-3">
            <label for="nome" class="form-label">Nome</label>
            <input type="text" name="nome" id="nome" class="form-control"
                value="<?= htmlspecialchars($administrador['nome']) ?>" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" id="email" class="form-control"
                value="<?= htmlspecialchars($administrador['email']) ?>" required>
        </div>

        <div class="mb-3">
            <label for="senha" class="form-label">Senha (preencha apenas se desejar alterar)</label>
            <input type="password" name="senha" id="senha" class="form-control">
        </div>

        <div class="d-flex flex-wrap gap-2">
            <button type="submit" class="btn btn-success">Salvar Alterações</button>
            <a href="index.php?page=administradores&action=listar" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>

<?php include BASE_PATH . '/views/partials/footer.php'; ?>