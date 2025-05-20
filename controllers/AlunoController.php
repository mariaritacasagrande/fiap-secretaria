<?php

class AlunoController
{
    private $model;

    public function __construct()
    {
        $this->model = new Aluno();
    }

    public function listar()
    {
        $alunos = $this->model->todos();
        include './views/alunos/listar.php';
    }

    public function criar()
    {
        include './views/alunos/criar.php';
    }

    public function salvar()
    {
        $this->model->salvar($_POST);
        header('Location: index.php?page=alunos&action=listar');
    }

    public function editar()
    {
        $aluno = $this->model->buscarPorId($_GET['id']);
        include './views/alunos/editar.php';
    }

    public function atualizar()
    {
        $this->model->atualizar($_POST);
        header('Location: index.php?page=alunos&action=listar');
    }

    public function excluir()
    {
        $this->model->excluir($_GET['id']);
        header('Location: index.php?page=alunos&action=listar');
    }
}