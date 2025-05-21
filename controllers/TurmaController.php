<?php
/**
 * Sistema desenvolvido por Maria Rita Casagrande
 * © 2025 Maria Rita Casagrande - Todos os direitos reservados
 * Repositório: https://github.com/mariaritacasagrande/fiap-secretaria
 */

require_once BASE_PATH . '/models/Turma.php';
require_once BASE_PATH . '/controllers/AuthController.php';

class TurmaController
{
    private $model;

    public function __construct()
    {
        AuthController::verificarAcesso();
        $this->model = new Turma();
    }

    public function listar()
    {
        $pagina = isset($_GET['pagina']) ? (int) $_GET['pagina'] : 1;
        $turmas = $this->model->todas($pagina);
        $totalPaginas = $this->model->totalPaginas();

        include BASE_PATH . '/views/turmas/listar.php';
    }

    public function criar()
    {
        include BASE_PATH . '/views/turmas/criar.php';
    }

    public function salvar()
    {
        try {
            $this->model->salvar($_POST);
            header('Location: index.php?page=turmas&action=listar');
            exit;
        } catch (Exception $e) {
            $erro = $e->getMessage();
            include BASE_PATH . '/views/turmas/criar.php';
        }
    }

    public function editar()
    {
        $turma = $this->model->buscarPorId($_GET['id']);
        include BASE_PATH . '/views/turmas/editar.php';
    }

    public function atualizar()
    {
        try {
            $this->model->atualizar($_POST);
            header('Location: index.php?page=turmas&action=listar');
            exit;
        } catch (Exception $e) {
            $erro = $e->getMessage();
            $turma = $_POST;
            include BASE_PATH . '/views/turmas/editar.php';
        }
    }

    public function excluir()
    {
        $this->model->excluir($_GET['id']);
        header('Location: index.php?page=turmas&action=listar');
        exit;
    }
}