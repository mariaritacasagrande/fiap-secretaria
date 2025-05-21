<?php

require_once BASE_PATH . '/config/database.php';

class Aluno
{
    private $conn;

    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->connect();
    }

    public function todos($nome = null)
    {
        if ($nome) {
            $sql = "SELECT * FROM alunos WHERE nome LIKE :nome ORDER BY nome ASC";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(':nome', '%' . $nome . '%', PDO::PARAM_STR);
        } else {
            $sql = "SELECT * FROM alunos ORDER BY nome ASC";
            $stmt = $this->conn->prepare($sql);
        }

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarPorId($id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM alunos WHERE id = :id");
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    private function senhaValida($senha)
    {
        return preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\\d)(?=.*[^a-zA-Z0-9]).{8,}$/', $senha);
    }

    public function salvar($dados)
    {
        if (!$this->senhaValida($dados['senha'])) {
            throw new Exception("A senha deve conter no mínimo 8 caracteres, incluindo letra maiúscula, minúscula, número e símbolo.");
        }

        $senhaCriptografada = password_hash($dados['senha'], PASSWORD_DEFAULT);

        $sql = "INSERT INTO alunos (nome, data_nascimento, cpf, email, senha)
                VALUES (:nome, :data_nascimento, :cpf, :email, :senha)";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':nome', $dados['nome']);
        $stmt->bindValue(':data_nascimento', $dados['data_nascimento']);
        $stmt->bindValue(':cpf', $dados['cpf']);
        $stmt->bindValue(':email', $dados['email']);
        $stmt->bindValue(':senha', $senhaCriptografada);
        return $stmt->execute();
    }

    public function atualizar($dados)
    {
        $atualizarSenha = !empty($dados['senha']);

        if ($atualizarSenha && !$this->senhaValida($dados['senha'])) {
            throw new Exception("A nova senha informada não atende os critérios mínimos de segurança.");
        }

        $sql = "UPDATE alunos SET nome = :nome, data_nascimento = :data_nascimento, cpf = :cpf, email = :email";
        if ($atualizarSenha) {
            $sql .= ", senha = :senha";
        }
        $sql .= " WHERE id = :id";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':id', $dados['id']);
        $stmt->bindValue(':nome', $dados['nome']);
        $stmt->bindValue(':data_nascimento', $dados['data_nascimento']);
        $stmt->bindValue(':cpf', $dados['cpf']);
        $stmt->bindValue(':email', $dados['email']);

        if ($atualizarSenha) {
            $senhaCriptografada = password_hash($dados['senha'], PASSWORD_DEFAULT);
            $stmt->bindValue(':senha', $senhaCriptografada);
        }

        return $stmt->execute();
    }

    public function excluir($id)
    {
        $stmt = $this->conn->prepare("DELETE FROM alunos WHERE id = :id");
        $stmt->bindValue(':id', $id);
        return $stmt->execute();
    }
}
