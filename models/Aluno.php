<?php

require_once __DIR__ . '/../config/Database.php';

class Aluno
{
    public function todos()
    {
        return $this->listar();
    }

    public function listar()
    {
        $conn = (new Database())->connect();
        $stmt = $conn->query("SELECT * FROM alunos ORDER BY nome ASC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarPorId($id)
    {
        $conn = (new Database())->connect();
        $stmt = $conn->prepare("SELECT * FROM alunos WHERE id = :id");
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function salvar($dados)
    {
        $conn = (new Database())->connect();
        $query = "INSERT INTO alunos (nome, data_nascimento, cpf, email, senha) 
                  VALUES (:nome, :data_nascimento, :cpf, :email, :senha)";
        $stmt = $conn->prepare($query);
        $stmt->bindValue(':nome', $dados['nome']);
        $stmt->bindValue(':data_nascimento', $dados['data_nascimento']);
        $stmt->bindValue(':cpf', $dados['cpf']);
        $stmt->bindValue(':email', $dados['email']);
        $stmt->bindValue(':senha', password_hash($dados['senha'], PASSWORD_DEFAULT));
        return $stmt->execute();
    }

    public function atualizar($id, $dados)
    {
        $conn = (new Database())->connect();
        $query = "UPDATE alunos SET nome = :nome, data_nascimento = :data_nascimento, cpf = :cpf, email = :email";

        if (!empty($dados['senha'])) {
            $query .= ", senha = :senha";
        }

        $query .= " WHERE id = :id";
        $stmt = $conn->prepare($query);
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
        $conn = (new Database())->connect();
        $stmt = $conn->prepare("DELETE FROM alunos WHERE id = :id");
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
