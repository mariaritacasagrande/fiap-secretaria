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

    <form id="formMatricula" method="POST" action="index.php?page=matriculas&action=criar" class="bg-white p-4 rounded shadow-sm">

        <div class="mb-3">
            <label class="form-label" for="filtroAluno">Buscar Aluno</label>
            <input type="text" id="filtroAluno" class="form-control" placeholder="Digite para filtrar por nome">
            <div class="form-text text-muted mt-1">Digite pelo menos 3 letras e tecle Enter para aplicar o filtro.</div>
        </div>

        <div class="mb-3">
            <label for="aluno_id" class="form-label">Aluno</label>
            <select name="aluno_id" id="aluno_id" class="form-select" required>
                <option value="" selected>Selecione um aluno</option>
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
            <div id="mensagemSemResultados" class="form-text text-danger d-none mt-1">
                Nenhum aluno encontrado com esse nome.
            </div>
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
    document.getElementById('filtroAluno').addEventListener('keypress', function (event) {
        if (event.key === 'Enter') {
            event.preventDefault();
            aplicarFiltroAluno();
        }
    });

    function aplicarFiltroAluno() {
        const filtro = document.getElementById('filtroAluno').value.toLowerCase().trim();
        const select = document.getElementById('aluno_id');
        const options = select.getElementsByTagName('option');
        const mensagem = document.getElementById('mensagemSemResultados');
        let encontrou = false;

        // Esconde todas as opções
        for (let i = 0; i < options.length; i++) {
            options[i].style.display = 'none';
        }

        // Se menos de 3 caracteres, reseta e sai sem mostrar nada
        if (filtro.length < 3) {
            mensagem.classList.add('d-none');
            select.selectedIndex = -1;
            return;
        }

        // Exibe opção padrão e reseta seleção
        options[0].style.display = '';
        select.selectedIndex = 0;

        // Filtra alunos
        for (let i = 1; i < options.length; i++) {
            const texto = options[i].textContent.toLowerCase();
            const match = texto.includes(filtro);
            options[i].style.display = match ? '' : 'none';
            if (match) encontrou = true;
        }

        // Exibe ou oculta mensagem de "nenhum encontrado"
        mensagem.classList.toggle('d-none', encontrou);

        // Força a validação do select apenas após ENTER e filtro válido
        select.setCustomValidity('');
        select.reportValidity();
    }
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
