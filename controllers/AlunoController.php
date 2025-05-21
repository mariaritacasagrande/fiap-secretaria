<?php

require_once BASE_PATH . '/models/Aluno.php';
require_once BASE_PATH . '/controllers/AuthController.php';

class AlunoController
{
    private $model;

    public function __construct()
    {
        AuthController::verificarAcesso();
        $this->model = new Aluno();
    }

    public function listar()
    {
        $nome = $_GET['busca'] ?? null;
        $alunos = $this->model->todos($nome);
        include BASE_PATH . '/views/alunos/listar.php';
    }

    public function criar()
    {
        $erro = $_GET['erro'] ?? null;
        include BASE_PATH . '/views/alunos/criar.php';
    }

    public function salvar()
    {
        try {
            $this->model->salvar($_POST);
            header('Location: index.php?page=alunos&action=listar');
            exit;
        } catch (Exception $e) {
            $erro = $e->getMessage();
            include BASE_PATH . '/views/alunos/criar.php';
        }
    }

    public function editar()
    {
        $aluno = $this->model->buscarPorId($_GET['id']);
        $erro = $_GET['erro'] ?? null;
        include BASE_PATH . '/views/alunos/editar.php';
    }

    public function atualizar()
    {
        try {
            $this->model->atualizar($_POST);
            header('Location: index.php?page=alunos&action=listar');
            exit;
        } catch (Exception $e) {
            $erro = $e->getMessage();
            $aluno = $this->model->buscarPorId($_POST['id']);
            include BASE_PATH . '/views/alunos/editar.php';
        }
    }

    public function excluir()
    {
        $this->model->excluir($_GET['id']);
        header('Location: index.php?page=alunos&action=listar');
        exit;
    }
}
