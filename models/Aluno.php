<?php

require_once __DIR__ . '/../config/Database.php';

class Aluno
{
    private $conn;

    public function __construct($conn = null)
    {
        $this->conn = $conn ?? (new Database())->connect();
    }

    public function listar()
    {
        $query = "SELECT * FROM alunos ORDER BY nome ASC";
        $stmt = $this->conn->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarPorId($id)
    {
        $query = "SELECT * FROM alunos WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function salvar($dados)
    {
        $query = "INSERT INTO alunos (nome, data_nascimento, cpf, email, senha) 
                  VALUES (:nome, :data_nascimento, :cpf, :email, :senha)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':nome', $dados['nome']);
        $stmt->bindValue(':data_nascimento', $dados['data_nascimento']);
        $stmt->bindValue(':cpf', $dados['cpf']);
        $stmt->bindValue(':email', $dados['email']);
        $stmt->bindValue(':senha', password_hash($dados['senha'], PASSWORD_DEFAULT));
        return $stmt->execute();
    }

    public function atualizar($id, $dados)
    {
        $query = "UPDATE alunos SET nome = :nome, data_nascimento = :data_nascimento, cpf = :cpf, email = :email";

        if (!empty($dados['senha'])) {
            $query .= ", senha = :senha";
        }

        $query .= " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':nome', $dados['nome']);
        $stmt->bindValue(':data_nascimento', $dados['data_nascimento']);
        $stmt->bindValue(':cpf', $dados['cpf']);
        $stmt->bindValue(':email', $dados['email']);
        $stmt->bindValue(':id', $id);

        if (!empty($dados['senha'])) {
            $stmt->bindValue(':senha', password_hash($dados['senha'], PASSWORD_DEFAULT));
        }

        return $stmt->execute();
    }

    public function excluir($id)
    {
        $query = "DELETE FROM alunos WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
