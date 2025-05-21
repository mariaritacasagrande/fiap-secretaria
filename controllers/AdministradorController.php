<?php

require_once BASE_PATH . '/models/Administrador.php';
require_once BASE_PATH . '/controllers/AuthController.php';

class AdministradorController
{
    private $model;

    public function __construct()
    {
        AuthController::verificarAcesso();
        $this->model = new Administrador();
    }

    public function listar()
    {
        $erro = $_GET['erro'] ?? null;
        $admins = $this->model->todos();
        include BASE_PATH . '/views/administradores/listar.php';
    }

    public function criar()
    {
        $erro = $_GET['erro'] ?? null;
        include BASE_PATH . '/views/administradores/criar.php';
    }

    public function salvar()
    {
        try {
            if (empty($_POST['senha']) || strlen($_POST['senha']) < 8) {
                throw new Exception("A senha deve conter no mínimo 8 caracteres.");
            }

            $this->model->salvar($_POST);
            header('Location: index.php?page=administradores&action=listar');
            exit;
        } catch (Exception $e) {
            $erro = $e->getMessage();
            include BASE_PATH . '/views/administradores/criar.php';
        }
    }

    public function editar()
    {
        $id = $_GET['id'] ?? null;
        $admin = $this->model->buscarPorId($id);

        if (!$admin) {
            header('Location: index.php?page=administradores&action=listar&erro=Administrador+não+encontrado');
            exit;
        }

        $erro = $_GET['erro'] ?? null;
        include BASE_PATH . '/views/administradores/editar.php';
    }

    public function atualizar()
    {
        try {
            if (!empty($_POST['senha']) && strlen($_POST['senha']) < 8) {
                throw new Exception("A nova senha deve conter no mínimo 8 caracteres.");
            }

            $this->model->atualizar($_POST);
            header('Location: index.php?page=administradores&action=listar');
            exit;
        } catch (Exception $e) {
            $erro = $e->getMessage();
            $admin = $this->model->buscarPorId($_POST['id']);
            include BASE_PATH . '/views/administradores/editar.php';
        }
    }

    public function excluir()
    {
        $id = $_GET['id'];
        if ($id == $_SESSION['admin_id']) {
            $erro = "Você não pode excluir seu próprio perfil.";
            $admins = $this->model->todos();
            include BASE_PATH . '/views/administradores/listar.php';
            return;
        }

        $this->model->excluir($id);
        header('Location: index.php?page=administradores&action=listar');
        exit;
    }
}
