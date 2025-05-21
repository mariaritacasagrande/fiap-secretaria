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
        $pagina = isset($_GET['pagina']) ? max(1, (int) $_GET['pagina']) : 1;
        $limite = 10;

        $administradores = $this->model->listar($pagina, $limite);
        $totalPaginas = $this->model->totalPaginas($limite);

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
        $administrador = $this->model->buscarPorId($_GET['id']);
        include BASE_PATH . '/views/administradores/editar.php';
    }

    public function atualizar()
    {
        $this->model->atualizar($_POST['id'], $_POST);
        header('Location: index.php?page=administradores&action=listar');
        exit;
    }

    public function excluir()
    {
        $this->model->excluir($_GET['id']);
        header('Location: index.php?page=administradores&action=listar');
        exit;
    }
}
