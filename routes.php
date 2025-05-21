<?php
/**
 * routes.php
 * Arquivo de roteamento principal com controle de acesso
 */

// Inicia a sessão (caso não tenha sido iniciada no public/index.php)
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// 1) Controle de acesso: se não estiver logado e não for rota de auth, manda para login
if (
    empty($_SESSION['admin_logado'])
    && !(isset($_GET['page']) && $_GET['page'] === 'auth')
) {
    header('Location: index.php?page=auth&action=login');
    exit;
}

// 2) Define página e ação padrão
$page = $_GET['page'] ?? 'dashboard';
$action = $_GET['action'] ?? 'index';

switch ($page) {

    // ROTA DO DASHBOARD
    case 'dashboard':
        require_once BASE_PATH . '/controllers/DashboardController.php';
        $ctrl = new DashboardController();
        $ctrl->{$action}();
        break;

    // ROTAS DE ALUNOS
    case 'alunos':
        require_once BASE_PATH . '/controllers/AlunoController.php';
        $ctrl = new AlunoController();
        $ctrl->{$action}();
        break;

    // ROTAS DE TURMAS
    case 'turmas':
        require_once BASE_PATH . '/controllers/TurmaController.php';
        $ctrl = new TurmaController();
        $ctrl->{$action}();
        break;

    // ROTAS DE MATRÍCULAS
    case 'matriculas':
        require_once BASE_PATH . '/controllers/MatriculaController.php';
        $ctrl = new MatriculaController();
        $ctrl->{$action}();
        break;

    // ROTAS DE ADMINISTRADORES
    case 'administradores':
        require_once BASE_PATH . '/controllers/AdministradorController.php';
        $ctrl = new AdministradorController();
        $ctrl->{$action}();
        break;

    // AUTENTICAÇÃO
    case 'auth':
        require_once BASE_PATH . '/controllers/AuthController.php';
        $ctrl = new AuthController();
        $ctrl->{$action}();
        break;

    // QUALQUER OUTRA COISA → ERRO 404
    default:
        http_response_code(404);
        echo '<h1>Página não encontrada</h1>';
        break;
}
