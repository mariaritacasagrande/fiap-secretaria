<?php

require_once BASE_PATH . '/config/database.php';

class Turma
{
    private $conn;

    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->connect();
    }

    // Retorna turmas paginadas (10 por página) com contagem de alunos
    public function todas($pagina = 1)
    {
        $limite = 10;
        $offset = ($pagina - 1) * $limite;

        $sql = "
            SELECT 
                t.*, 
                COUNT(m.id) AS total_alunos 
            FROM turmas t
            LEFT JOIN matriculas m ON m.turma_id = t.id
            GROUP BY t.id
            ORDER BY t.nome ASC
            LIMIT :limite OFFSET :offset
        ";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':limite', $limite, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function salvar($dados)
    {
        $this->validar($dados);

        $sql = "INSERT INTO turmas (nome, descricao) VALUES (:nome, :descricao)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':nome', $dados['nome']);
        $stmt->bindValue(':descricao', $dados['descricao']);
        return $stmt->execute();
    }

    public function buscarPorId($id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM turmas WHERE id = :id");
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function atualizar($dados)
    {
        $this->validar($dados);

        $sql = "UPDATE turmas SET nome = :nome, descricao = :descricao WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':nome', $dados['nome']);
        $stmt->bindValue(':descricao', $dados['descricao']);
        $stmt->bindValue(':id', $dados['id'], PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function excluir($id)
    {
        $stmt = $this->conn->prepare("DELETE FROM turmas WHERE id = :id");
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    private function validar($dados)
    {
        if (strlen(trim($dados['nome'])) < 3) {
            throw new Exception("O nome da turma deve ter no mínimo 3 caracteres.");
        }

        if (empty($dados['descricao'])) {
            throw new Exception("A descrição da turma é obrigatória.");
        }
    }

    public function totalPaginas()
    {
        $stmt = $this->conn->query("SELECT COUNT(*) AS total FROM turmas");
        $total = $stmt->fetch(PDO::FETCH_ASSOC)['total'];
        return ceil($total / 10);
    }
}
