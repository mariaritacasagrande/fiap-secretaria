<?php
/**
 * Sistema desenvolvido por Maria Rita Casagrande
 * © 2025 Maria Rita Casagrande - Todos os direitos reservados
 * Repositório: https://github.com/mariaritacasagrande/fiap-secretaria
 */
require_once BASE_PATH . '/models/Matricula.php';
require_once BASE_PATH . '/controllers/AuthController.php';

class MatriculaController
{
    private $model;

    public function __construct()
    {
        AuthController::verificarAcesso();
        $this->model = new Matricula();
    }

    public function listar()
    {
        $pagina = isset($_GET['pagina']) ? max(1, (int) $_GET['pagina']) : 1;
        $limite = 10;

        $matriculas = $this->model->listar($pagina, $limite);
        $totalPaginas = $this->model->totalPaginas($limite);

        include BASE_PATH . '/views/matriculas/listar.php';
    }

    public function criar()
    {
        $erro = $_GET['erro'] ?? null;
        $alunos = $this->model->listarAlunos();
        $turmas = $this->model->listarTurmas();

        include BASE_PATH . '/views/matriculas/criar.php';
    }

    public function salvar()
    {
        try {
            $this->model->salvar($_POST);
            header('Location: index.php?page=matriculas&action=listar');
            exit;
        } catch (Exception $e) {
            $erro = $e->getMessage();
            $alunos = $this->model->listarAlunos();
            $turmas = $this->model->listarTurmas();
            include BASE_PATH . '/views/matriculas/criar.php';
        }
    }

    public function excluir()
    {
        $this->model->excluir($_GET['id']);
        header('Location: index.php?page=matriculas&action=listar');
        exit;
    }
}
