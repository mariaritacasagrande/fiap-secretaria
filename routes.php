<?php
$page = $_GET['page'] ?? 'alunos';
$action = $_GET['action'] ?? 'listar';

$controller = new AlunoController();

switch ("{$page}.{$action}") {
    case 'alunos.listar':
        $controller->listar();
        break;
    case 'alunos.criar':
        $controller->criar();
        break;
    case 'alunos.editar':
        $controller->editar();
        break;
    case 'alunos.salvar':
        $controller->salvar();
        break;
    case 'alunos.atualizar':
        $controller->atualizar();
        break;
    case 'alunos.excluir':
        $controller->excluir();
        break;
    default:
        echo "Página não encontrada.";
}