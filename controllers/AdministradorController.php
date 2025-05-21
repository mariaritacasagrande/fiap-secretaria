<?php

require_once __DIR__ . '/../models/Administrador.php';

class AdministradorController {

    private $model;

    public function __construct() {
        $this->model = new Administrador();
    }

    public function listar() {
        $administradores = $this->model->buscarTodos();
        include __DIR__ . '/../views/administradores/listar.php';
    }

    public function criar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nome = $_POST['nome'] ?? '';
            $email = $_POST['email'] ?? '';
            $senha = $_POST['senha'] ?? '';
            $this->model->inserir($nome, $email, $senha);
            header('Location: index.php?page=administradores&action=listar');
            exit;
        }
        include __DIR__ . '/../views/administradores/criar.php';
    }

    public function editar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = isset($_POST['id']) ? (int)$_POST['id'] : 0;
            if ($id <= 0) {
                $erro = "ID inválido.";
                include __DIR__ . '/../views/administradores/editar.php';
                return;
            }

            $nome = $_POST['nome'] ?? '';
            $email = $_POST['email'] ?? '';
            $senha = $_POST['senha'] ?? null;
            $this->model->atualizar($id, $nome, $email, $senha);
            header('Location: index.php?page=administradores&action=listar');
            exit;
        }

        $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
        if ($id <= 0) {
            $erro = "ID inválido.";
            include __DIR__ . '/../views/administradores/editar.php';
            return;
        }

        $admin = $this->model->buscarPorId($id);
        if (!$admin) {
            $erro = "Administrador não encontrado.";
        }

        include __DIR__ . '/../views/administradores/editar.php';
    }

    public function excluir() {
        $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

        // Regra 1: Não permitir excluir o administrador principal (ID 1)
        if ($id === 1) {
            $erro = "O administrador principal não pode ser excluído.";
            $administradores = $this->model->buscarTodos();
            include __DIR__ . '/../views/administradores/listar.php';
            return;
        }

        // Regra 2: Não permitir excluir se houver apenas 1 administrador
        $todos = $this->model->buscarTodos();
        if (count($todos) <= 1) {
            $erro = "Não é possível excluir o último administrador do sistema.";
            $administradores = $todos;
            include __DIR__ . '/../views/administradores/listar.php';
            return;
        }

        if ($id > 0) {
            $this->model->excluir($id);
        }

        header('Location: index.php?page=administradores&action=listar');
        exit;
    }
}
