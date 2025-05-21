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
        <?php
            // Mensagem amigável para duplicidade de CPF, E-mail ou senha fraca
            if (stripos($erro, 'cpf') !== false) {
                $friendly = 'CPF já cadastrado.';
            } elseif (stripos($erro, 'email') !== false) {
                $friendly = 'E-mail já cadastrado.';
            } elseif (stripos($erro, 'senha') !== false) {
                $friendly = 'Senha não atende aos requisitos mínimos.';
            } else {
                $friendly = 'Erro ao atualizar aluno.';
            }
        ?>
        <div class="alert alert-danger">
            <?= htmlspecialchars($friendly) ?>
        </div>
    <?php endif; ?>

    <form method="POST" action="index.php?page=alunos&action=atualizar" class="bg-white p-4 rounded shadow-sm needs-validation" novalidate>
        <input type="hidden" name="id" value="<?= htmlspecialchars($aluno['id']) ?>">

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="nome" class="form-label">Nome completo</label>
                <input type="text" class="form-control" id="nome" name="nome" required minlength="3" value="<?= htmlspecialchars($aluno['nome']) ?>">
                <div class="invalid-feedback">
                    Informe o nome completo (mínimo 3 caracteres).
                </div>
            </div>
            <div class="col-md-3">
                <label for="data_nascimento" class="form-label">Data de nascimento</label>
                <input type="date" class="form-control" id="data_nascimento" name="data_nascimento" required value="<?= htmlspecialchars($aluno['data_nascimento']) ?>">
                <div class="invalid-feedback">
                    Informe uma data de nascimento válida.
                </div>
            </div>
            <div class="col-md-3">
                <label for="cpf" class="form-label">CPF</label>
                <input type="text" class="form-control <?= (!empty($erro) && stripos($erro, 'cpf') !== false) ? 'is-invalid' : '' ?>" id="cpf" name="cpf" required value="<?= htmlspecialchars($aluno['cpf']) ?>">
                <?php if (!empty($erro) && stripos($erro, 'cpf') !== false): ?>
                    <div class="invalid-feedback d-block">
                        <?= htmlspecialchars($friendly) ?>
                    </div>
                <?php else: ?>
                    <div class="invalid-feedback">
                        Informe um CPF válido.
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="email" class="form-label">E-mail</label>
                <input type="email" class="form-control <?= (!empty($erro) && stripos($erro, 'email') !== false) ? 'is-invalid' : '' ?>" id="email" name="email" required value="<?= htmlspecialchars($aluno['email']) ?>">
                <?php if (!empty($erro) && stripos($erro, 'email') !== false): ?>
                    <div class="invalid-feedback d-block">
                        <?= htmlspecialchars($friendly) ?>
                    </div>
                <?php else: ?>
                    <div class="invalid-feedback">
                        Informe um e-mail válido.
                    </div>
                <?php endif; ?>
            </div>
            <div class="col-md-6">
                <label for="senha" class="form-label">Nova Senha (opcional)</label>
                <input type="password"
                       class="form-control <?= (!empty($erro) && stripos($erro, 'senha') !== false) ? 'is-invalid' : '' ?>"
                       id="senha"
                       name="senha"
                       pattern="(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*\W).{8,}">
                <div class="form-text">
                    Preencha apenas se desejar alterar a senha. Deve conter no mínimo 8 caracteres, incluindo letra maiúscula, minúscula, número e símbolo.
                </div>
                <?php if (!empty($erro) && stripos($erro, 'senha') !== false): ?>
                    <div class="invalid-feedback d-block">
                        <?= htmlspecialchars($friendly) ?>
                    </div>
                <?php else: ?>
                    <div class="invalid-feedback">
                        A senha não atende aos requisitos mínimos.
                    </div>
                <?php endif; ?>
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
<script>
(function () {
    'use strict';
    var forms = document.querySelectorAll('.needs-validation');
    Array.prototype.slice.call(forms)
        .forEach(function (form) {
            form.addEventListener('submit', function (event) {
                // Se senha vazia, remove atributo pattern para não invalidar
                var password = form.querySelector('#senha');
                if (password.value === '') {
                    password.removeAttribute('pattern');
                }
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);

            // Limpar erro ao digitar
            var emailField = form.querySelector('#email');
            var cpfField = form.querySelector('#cpf');
            var passField = form.querySelector('#senha');

            [emailField, cpfField, passField].forEach(function(field) {
                field.addEventListener('input', function () {
                    if (field.checkValidity()) {
                        field.classList.remove('is-invalid');
                        var feedback = field.nextElementSibling;
                        if (feedback && feedback.classList.contains('invalid-feedback')) {
                            feedback.classList.remove('d-block');
                        }
                    }
                });
            });
        });
})();
</script>
</body>
</html>
