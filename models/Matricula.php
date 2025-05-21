<?php

/**
 * Sistema desenvolvido por Maria Rita Casagrande
 * © 2025 Maria Rita Casagrande - Todos os direitos reservados
 * Repositório: https://github.com/mariaritacasagrande/fiap-secretaria
 */

require_once __DIR__ . '/../config/Database.php';

class Matricula
{
    public function listar($pagina = 1, $limite = 10, $turmaId = null)
    {
        $offset = ($pagina - 1) * $limite;
        $conn = (new Database())->connect();

        $query = "
            SELECT m.*, a.nome AS nome_aluno, t.nome AS nome_turma
            FROM matriculas m
            JOIN alunos a ON m.aluno_id = a.id
            JOIN turmas t ON m.turma_id = t.id
        ";

        if ($turmaId) {
            $query .= " WHERE m.turma_id = :turma_id";
        }

        $query .= " ORDER BY a.nome ASC LIMIT :limite OFFSET :offset";
        $stmt = $conn->prepare($query);

        if ($turmaId) {
            $stmt->bindValue(':turma_id', $turmaId, PDO::PARAM_INT);
        }

        $stmt->bindValue(':limite', $limite, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function totalPaginas($limite = 10, $turmaId = null)
    {
        $conn = (new Database())->connect();

        $sql = "SELECT COUNT(*) AS total FROM matriculas";
        if ($turmaId) {
            $sql .= " WHERE turma_id = :turma_id";
        }

        $stmt = $conn->prepare($sql);

        if ($turmaId) {
            $stmt->bindValue(':turma_id', $turmaId, PDO::PARAM_INT);
        }

        $stmt->execute();
        $total = $stmt->fetch(PDO::FETCH_ASSOC)['total'] ?? 0;

        return ceil($total / $limite);
    }

    public function listarAlunos()
    {
        $conn = (new Database())->connect();
        $stmt = $conn->query("SELECT * FROM alunos ORDER BY nome ASC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function listarTurmas()
    {
        $conn = (new Database())->connect();
        $stmt = $conn->query("SELECT * FROM turmas ORDER BY nome ASC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarPorId($id)
    {
        $conn = (new Database())->connect();
        $stmt = $conn->prepare("SELECT * FROM matriculas WHERE id = :id");
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function salvar($dados)
    {
        $conn = (new Database())->connect();
        $query = "INSERT INTO matriculas (aluno_id, turma_id) VALUES (:aluno_id, :turma_id)";
        $stmt = $conn->prepare($query);
        $stmt->bindValue(':aluno_id', $dados['aluno_id'], PDO::PARAM_INT);
        $stmt->bindValue(':turma_id', $dados['turma_id'], PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function existe(int $alunoId, int $turmaId): bool
    {
        $conn = (new Database())->connect();
        $stmt = $conn->prepare("SELECT COUNT(*) AS total FROM matriculas WHERE aluno_id = :aluno_id AND turma_id = :turma_id");
        $stmt->bindValue(':aluno_id', $alunoId, PDO::PARAM_INT);
        $stmt->bindValue(':turma_id', $turmaId, PDO::PARAM_INT);
        $stmt->execute();
        $total = $stmt->fetch(PDO::FETCH_ASSOC)['total'] ?? 0;
        return $total > 0;
    }

    public function excluir($id)
    {
        $conn = (new Database())->connect();
        $stmt = $conn->prepare("DELETE FROM matriculas WHERE id = :id");
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}