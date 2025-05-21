<?php

/**
 * Sistema desenvolvido por Maria Rita Casagrande
 * © 2025 Maria Rita Casagrande - Todos os direitos reservados
 * Repositório: https://github.com/mariaritacasagrande/fiap-secretaria
 */

require_once __DIR__ . '/../config/Database.php';

class Turma
{
    public function todas()
    {
        return $this->listar();
    }

    public function listar()
    {
        $conn = (new Database())->connect();
        $query = "
            SELECT 
                t.*, 
                COUNT(m.id) AS total_alunos
            FROM turmas t
            LEFT JOIN matriculas m ON m.turma_id = t.id
            GROUP BY t.id
            ORDER BY t.nome ASC
        ";
        $stmt = $conn->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function totalPaginas($limitePorPagina = 10)
    {
        $conn = (new Database())->connect();
        $stmt = $conn->query("SELECT COUNT(*) AS total FROM turmas");
        $total = $stmt->fetch(PDO::FETCH_ASSOC)['total'] ?? 0;
        return ceil($total / $limitePorPagina);
    }

    public function buscarPorId($id)
    {
        $conn = (new Database())->connect();
        $stmt = $conn->prepare("SELECT * FROM turmas WHERE id = :id");
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function salvar($dados)
    {
        $conn = (new Database())->connect();
        $query = "INSERT INTO turmas (nome, codigo) VALUES (:nome, :codigo)";
        $stmt = $conn->prepare($query);
        $stmt->bindValue(':nome', $dados['nome']);
        $stmt->bindValue(':codigo', $dados['codigo']);
        return $stmt->execute();
    }

    public function atualizar($id, $dados)
    {
        $conn = (new Database())->connect();
        $query = "UPDATE turmas SET nome = :nome, codigo = :codigo WHERE id = :id";
        $stmt = $conn->prepare($query);
        $stmt->bindValue(':nome', $dados['nome']);
        $stmt->bindValue(':codigo', $dados['codigo']);
        $stmt->bindValue(':id', $id);
        return $stmt->execute();
    }

    public function excluir($id)
    {
        $conn = (new Database())->connect();
        $stmt = $conn->prepare("DELETE FROM turmas WHERE id = :id");
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
