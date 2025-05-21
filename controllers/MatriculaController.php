<?php

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

    public function criar()
    {
        $alunos = $this->model->listarAlunos();
        $turmas = $this->model->listarTurmas();
        $erro = $_GET['erro'] ?? null;

        include BASE_PATH . '/views/matriculas/criar.php';
    }

    public function salvar()
    {
        try {
            $this->model->matricular($_POST['aluno_id'], $_POST['turma_id']);
            header('Location: index.php?page=alunos&action=listar');
            exit;
        } catch (Exception $e) {
            $erro = $e->getMessage();
            $alunos = $this->model->listarAlunos();
            $turmas = $this->model->listarTurmas();
            include BASE_PATH . '/views/matriculas/criar.php';
        }
    }

    public function listarPorTurma()
    {
        if (!isset($_GET['turma_id'])) {
            echo "<h3>Turma não especificada.</h3>";
            return;
        }

        $turmaId = (int) $_GET['turma_id'];
        $alunos = $this->model->listarPorTurma($turmaId);
        include BASE_PATH . '/views/matriculas/listar.php';
    }

    public function listarPorAluno()
    {
        $alunoId = $_GET['id'] ?? null;
        if (!$alunoId) {
            echo "<h3>ID do aluno não especificado.</h3>";
            return;
        }

        $turmas = $this->model->listarTurmasDoAluno($alunoId);
        include BASE_PATH . '/views/matriculas/turmas-do-aluno.php';
    }
}
