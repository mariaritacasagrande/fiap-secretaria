<?php
require_once '../../config/auth.php';
require_once '../../controllers/AlunoController.php';
require_once '../../controllers/TurmaController.php';

$pesquisa = isset($_GET['pesquisa']) ? trim($_GET['pesquisa']) : '';

$alunoController = new AlunoController();
$turmaController = new TurmaController();

$alunos = $alunoController->buscarPorNome($pesquisa); // método a ser implementado no controller
$turmas = $turmaController->listar();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Nova Matrícula</title>
    <link rel="stylesheet" href="../../public/css/style.css">
    <link rel="stylesheet" href="../../public/css/responsivo.css">
</head>
<body>
    <?php include '../layouts/header.php'; ?>

    <main class="container">
        <h1>Criar Nova Matrícula</h1>

        <form method="GET" action="criar.php" class="form-inline mb-3">
            <label for="pesquisa">Buscar aluno:</label>
            <input type="text" id="pesquisa" name="pesquisa" value="<?= htmlspecialchars($pesquisa, ENT_QUOTES, 'UTF-8') ?>">
            <button type="submit">Buscar</button>
        </form>

        <form action="../../controllers/MatriculaController.php" method="POST">
            <input type="hidden" name="acao" value="criar">

            <div class="form-group">
                <label for="aluno_id">Aluno:</label>
                <select name="aluno_id" id="aluno_id" required>
                    <option value="">Selecione um aluno</option>
                    <?php foreach ($alunos as $aluno): ?>
                        <option value="<?= $aluno['id'] ?>">
                            <?= htmlspecialchars($aluno['nome'], ENT_QUOTES, 'UTF-8') ?> (<?= htmlspecialchars($aluno['email'] ?? '-', ENT_QUOTES, 'UTF-8') ?>)
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="turma_id">Turma:</label>
                <select name="turma_id" id="turma_id" required>
                    <option value="">Selecione uma turma</option>
                    <?php foreach ($turmas as $turma): ?>
                        <option value="<?= $turma['id'] ?>">
                            <?= htmlspecialchars($turma['nome'], ENT_QUOTES, 'UTF-8') ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <button type="submit" class="btn">Matricular</button>
        </form>
    </main>

    <?php include '../layouts/footer.php'; ?>
</body>
</html>
