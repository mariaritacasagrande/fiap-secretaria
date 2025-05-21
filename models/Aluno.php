<?php

/**
 * Sistema desenvolvido por Maria Rita Casagrande
 * © 2025 Maria Rita Casagrande - Todos os direitos reservados
 * Repositório: https://github.com/mariaritacasagrande/fiap-secretaria
 */

require_once __DIR__ . '/../config/Database.php';

class Aluno
{
    public function listar($pagina = 1, $limite = 10)
    {
        $offset = ($pagina - 1) * $limite;
        $conn = (new Database())->connect();
        $stmt = $conn->prepare("SELECT * FROM alunos ORDER BY nome ASC LIMIT :limite OFFSET :offset");
        $stmt->bindValue(':limite', $limite, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function totalPaginas($limite = 10)
    {
        $conn = (new Database())->connect();
        $stmt = $conn->query("SELECT COUNT(*) AS total FROM alunos");
        $total = $stmt->fetch(PDO::FETCH_ASSOC)['total'] ?? 0;
        return ceil($total / $limite);
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
