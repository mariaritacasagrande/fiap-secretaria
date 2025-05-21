<?php include BASE_PATH . '/views/partials/header.php'; ?>

<div class="container-fluid px-4">
    <h1 class="mb-4 fs-3">Lista de Administradores</h1>

    <div class="mb-3">
        <a href="index.php?page=administradores&action=criar" class="btn btn-primary">Novo Administrador</a>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="table-light">
                <tr>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($administradores)): ?>
                    <?php foreach ($administradores as $admin): ?>
                        <tr>
                            <td><?= htmlspecialchars($admin['nome']) ?></td>
                            <td><?= htmlspecialchars($admin['email']) ?></td>
                            <td>
                                <a href="index.php?page=administradores&action=editar&id=<?= $admin['id'] ?>"
                                    class="btn btn-sm btn-warning">Editar</a>
                                <a href="index.php?page=administradores&action=excluir&id=<?= $admin['id'] ?>"
                                    class="btn btn-sm btn-danger"
                                    onclick="return confirm('Tem certeza que deseja excluir este administrador?')">Excluir</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="3" class="text-center">Nenhum administrador cadastrado.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <nav class="mt-4">
        <ul class="pagination justify-content-center">
            <?php for ($i = 1; $i <= $totalPaginas; $i++): ?>
                <li class="page-item <?= ($i == ($_GET['pagina'] ?? 1)) ? 'active' : '' ?>">
                    <a class="page-link" href="index.php?page=administradores&action=listar&pagina=<?= $i ?>">
                        <?= $i ?>
                    </a>
                </li>
            <?php endfor; ?>
        </ul>
    </nav>
</div>

<?php include BASE_PATH . '/views/partials/footer.php'; ?>