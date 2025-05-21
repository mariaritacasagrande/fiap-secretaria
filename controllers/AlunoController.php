<?php
/**
 * Sistema desenvolvido por Maria Rita Casagrande
 * © 2025 Maria Rita Casagrande - Todos os direitos reservados
 * Repositório: https://github.com/mariaritacasagrande/fiap-secretaria
 */
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
        $pagina = isset($_GET['pagina']) ? max(1, (int) $_GET['pagina']) : 1;
        $limite = 10;

        $alunos = $this->model->listar($pagina, $limite);
        $totalPaginas = $this->model->totalPaginas($limite);

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
        } catch (\PDOException $e) {
            if ($e->getCode() === '23000') {
                if (stripos($e->getMessage(), 'cpf') !== false) {
                    $erro = 'CPF já cadastrado.';
                } elseif (stripos($e->getMessage(), 'email') !== false) {
                    $erro = 'Email já cadastrado.';
                } else {
                    $erro = 'Dado duplicado impede cadastro.';
                }
            } else {
                $erro = $e->getMessage();
            }
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