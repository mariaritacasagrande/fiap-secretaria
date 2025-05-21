<?php
require_once __DIR__ . '/../config/Database.php';
require_once __DIR__ . '/../models/Aluno.php';

class AlunoController
{
    private $conn;

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->connect();
    }

    public function listar()
    {
        $query = "SELECT * FROM alunos ORDER BY nome ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarPorNome($nome)
    {
        if (empty($nome)) {
            return $this->listar();
        }

        $query = "SELECT * FROM alunos WHERE nome LIKE :nome ORDER BY nome ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':nome', '%' . $nome . '%', PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarPorId($id)
    {
        $query = "SELECT * FROM alunos WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function criar($dados)
    {
        if (!$this->validar($dados)) {
            return false;
        }

        $query = "INSERT INTO alunos (nome, data_nascimento, cpf, email, senha) 
                  VALUES (:nome, :data_nascimento, :cpf, :email, :senha)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':nome', $dados['nome'], PDO::PARAM_STR);
        $stmt->bindValue(':data_nascimento', $dados['data_nascimento'], PDO::PARAM_STR);
        $stmt->bindValue(':cpf', $dados['cpf'], PDO::PARAM_STR);
        $stmt->bindValue(':email', $dados['email'], PDO::PARAM_STR);
        $stmt->bindValue(':senha', password_hash($dados['senha'], PASSWORD_DEFAULT), PDO::PARAM_STR);

        return $stmt->execute();
    }

    public function atualizar($id, $dados)
    {
        if (!$this->validar($dados, $id)) {
            return false;
        }

        $query = "UPDATE alunos SET nome = :nome, data_nascimento = :data_nascimento, cpf = :cpf, email = :email";

        if (!empty($dados['senha'])) {
            $query .= ", senha = :senha";
        }

        $query .= " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':nome', $dados['nome'], PDO::PARAM_STR);
        $stmt->bindValue(':data_nascimento', $dados['data_nascimento'], PDO::PARAM_STR);
        $stmt->bindValue(':cpf', $dados['cpf'], PDO::PARAM_STR);
        $stmt->bindValue(':email', $dados['email'], PDO::PARAM_STR);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);

        if (!empty($dados['senha'])) {
            $stmt->bindValue(':senha', password_hash($dados['senha'], PASSWORD_DEFAULT), PDO::PARAM_STR);
        }

        return $stmt->execute();
    }

    public function deletar($id)
    {
        $query = "DELETE FROM alunos WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    private function validar($dados, $id = null)
    {
        if (strlen(trim($dados['nome'])) < 3) {
            return false;
        }

        if (!filter_var($dados['email'], FILTER_VALIDATE_EMAIL)) {
            return false;
        }

        if (empty($id)) {
            // Verificar CPF ou Email duplicado
            $query = "SELECT COUNT(*) FROM alunos WHERE cpf = :cpf OR email = :email";
            $stmt = $this->conn->prepare($query);
            $stmt->bindValue(':cpf', $dados['cpf'], PDO::PARAM_STR);
            $stmt->bindValue(':email', $dados['email'], PDO::PARAM_STR);
            $stmt->execute();
            $existe = $stmt->fetchColumn();
            if ($existe > 0) {
                return false;
            }

            // Verifica força da senha
            if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\W).{8,}$/', $dados['senha'])) {
                return false;
            }
        }

        return true;
    }
}
