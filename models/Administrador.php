<?php

require_once __DIR__ . '/../config/database.php';

class Administrador {

    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->connect();
    }

    public function buscarTodos() {
        $stmt = $this->conn->prepare("SELECT * FROM admins");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarPorId($id) {
        $stmt = $this->conn->prepare("SELECT * FROM admins WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function inserir($nome, $email, $senha) {
        $hash = password_hash($senha, PASSWORD_DEFAULT);
        $stmt = $this->conn->prepare("INSERT INTO admins (nome, email, senha) VALUES (:nome, :email, :senha)");
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':senha', $hash);
        return $stmt->execute();
    }

    public function atualizar($id, $nome, $email, $senha = null) {
        if ($senha) {
            $hash = password_hash($senha, PASSWORD_DEFAULT);
            $stmt = $this->conn->prepare("UPDATE admins SET nome = :nome, email = :email, senha = :senha WHERE id = :id");
            $stmt->bindParam(':senha', $hash);
        } else {
            $stmt = $this->conn->prepare("UPDATE admins SET nome = :nome, email = :email WHERE id = :id");
        }

        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function excluir($id) {
        $stmt = $this->conn->prepare("DELETE FROM admins WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
