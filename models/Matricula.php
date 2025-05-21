<?php

require_once BASE_PATH . '/config/database.php';

class Matricula
{
    private $conn;

    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->connect();
    }

    public function listarPorTurma($turmaId)
    {
        $sql = "
            SELECT a.nome, a.email, a.cpf, m.criado_em
            FROM matriculas m
            INNER JOIN alunos a ON a.id = m.aluno_id
            WHERE m.turma_id = :turma_id
            ORDER BY a.nome ASC
        ";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':turma_id', $turmaId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function listarTurmas()
    {
        $stmt = $this->conn->query("SELECT id, nome FROM turmas ORDER BY nome ASC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function listarAlunos()
    {
        $stmt = $this->conn->query("SELECT id, nome FROM alunos ORDER BY nome ASC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function matricular($alunoId, $turmaId)
    {
        if ($this->jaMatriculado($alunoId, $turmaId)) {
            throw new Exception("O aluno já está matriculado nesta turma.");
        }

        $sql = "INSERT INTO matriculas (aluno_id, turma_id) VALUES (:aluno_id, :turma_id)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':aluno_id', $alunoId, PDO::PARAM_INT);
        $stmt->bindValue(':turma_id', $turmaId, PDO::PARAM_INT);
        return $stmt->execute();
    }

    private function jaMatriculado($alunoId, $turmaId)
    {
        $sql = "SELECT 1 FROM matriculas WHERE aluno_id = :aluno_id AND turma_id = :turma_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':aluno_id', $alunoId, PDO::PARAM_INT);
        $stmt->bindValue(':turma_id', $turmaId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch() !== false;
    }

    public function listarTurmasDoAluno($alunoId)
    {
        $sql = "
            SELECT t.nome, t.descricao, m.criado_em
            FROM matriculas m
            INNER JOIN turmas t ON t.id = m.turma_id
            WHERE m.aluno_id = :aluno_id
            ORDER BY t.nome ASC
        ";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':aluno_id', $alunoId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
