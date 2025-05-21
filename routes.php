<?php

$page = $_GET['page'] ?? 'alunos';
$action = $_GET['action'] ?? 'listar';

switch ($page) {
    case 'alunos':
        require_once BASE_PATH . '/controllers/AlunoController.php';
        $controller = new AlunoController();
        break;

    case 'turmas':
        require_once BASE_PATH . '/controllers/TurmaController.php';
        $controller = new TurmaController();
        break;

    case 'matriculas':
        require_once BASE_PATH . '/controllers/MatriculaController.php';
        $controller = new MatriculaController();
        break;

    case 'auth':
        require_once BASE_PATH . '/controllers/AuthController.php';
        $controller = new AuthController();
        break;

    case 'administradores':
        require_once BASE_PATH . '/controllers/AdministradorController.php';
        $controller = new AdministradorController();
        break;

    default:
        echo "Página não encontrada.";
        exit;
}

if (!method_exists($controller, $action)) {
    echo "Ação '{$action}' não definida para '{$page}'.";
    exit;
}

$controller->$action();
