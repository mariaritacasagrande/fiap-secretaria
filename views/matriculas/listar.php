<?php include BASE_PATH . '/views/partials/header.php'; ?>

<div class="container-fluid px-4">
    <h1 class="mb-4 fs-3">
        Lista de Matrículas
        <?php if (!empty($matriculas) && isset($matriculas[0]['nome_turma']) && isset($_GET['turma_id'])): ?>
            da Turma: <span class="text-primary"><?= htmlspecialchars($matriculas[0]['nome_turma']) ?></span>
        <?php endif; ?>
    </h1>

    <div class="mb-3">
        <a href="index.php?page=matriculas&action=criar" class="btn btn-primary">Nova Matrícula</a>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="table-light">
                <tr>
                    <th>Aluno</th>
                    <th>Turma</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($matriculas)): ?>
                    <?php foreach ($matriculas as $matricula): ?>
                        <tr>
                            <td><?= htmlspecialchars($matricula['nome_aluno']) ?></td>
                            <td><?= htmlspecialchars($matricula['nome_turma']) ?></td>
                            <td>
                                <a href="index.php?page=matriculas&action=excluir&id=<?= $matricula['id'] ?>"
                                    class="btn btn-sm btn-danger"
                                    onclick="return confirm('Tem certeza que deseja excluir esta matrícula?')">Excluir</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="3" class="text-center">Nenhuma matrícula encontrada.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <nav class="mt-4">
        <ul class="pagination justify-content-center">
            <?php for ($i = 1; $i <= $totalPaginas; $i++): ?>
                <li class="page-item <?= ($i == ($_GET['pagina'] ?? 1)) ? 'active' : '' ?>">
                    <a class="page-link"
                        href="index.php?page=matriculas&action=listar&pagina=<?= $i ?><?= isset($_GET['turma_id']) ? '&turma_id=' . (int) $_GET['turma_id'] : '' ?>">
                        <?= $i ?>
                    </a>
                </li>
            <?php endfor; ?>
        </ul>
    </nav>
</div>

<?php include BASE_PATH . '/views/partials/footer.php'; ?>