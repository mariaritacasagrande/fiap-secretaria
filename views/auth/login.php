<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Login do Administrador</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        .login-box {
            max-width: 400px;
            margin: 80px auto;
            padding: 2rem;
            box-shadow: 0 0 10px #ccc;
            border-radius: 8px;
            background: #fff;
        }
    </style>
</head>

<body class="bg-light">
    <div class="login-box text-center">
        <h1 class="mb-3 text-primary"><i class="bi bi-mortarboard-fill me-2"></i>FIAP Secretaria</h1>
        <h2 class="mb-4 text-secondary">Acesso Administrativo</h2>

        <?php if (!empty($erro)): ?>
            <div class="alert alert-danger">E-mail ou senha inválidos.</div>
        <?php endif; ?>

        <form method="POST" action="index.php?page=auth&action=autenticar">
            <div class="mb-3 text-start">
                <label for="email" class="form-label">E-mail</label>
                <input type="email" class="form-control" id="email" name="email" required
                    placeholder="admin@fiap.com.br">
            </div>

            <div class="mb-3 text-start">
                <label for="senha" class="form-label">Senha</label>
                <input type="password" class="form-control" id="senha" name="senha" required>
            </div>

            <button type="submit" class="btn btn-primary w-100">Entrar</button>
        </form>
    </div>
</body>

</html>