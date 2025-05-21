<?php
/**
 * Sistema desenvolvido por Maria Rita Casagrande
 * © 2025 Maria Rita Casagrande - Todos os direitos reservados
 * Repositório: https://github.com/mariaritacasagrande/fiap-secretaria
 */
require_once BASE_PATH . '/config/database.php';

class AuthController
{
    private $conn;

    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $db = new Database();
        $this->conn = $db->connect();
    }

    public function login()
    {
        $erro = $_GET['erro'] ?? null;
        include BASE_PATH . '/views/auth/login.php';
    }

    public function autenticar()
    {
        $email = $_POST['email'] ?? '';
        $senha = $_POST['senha'] ?? '';

        $sql = "SELECT * FROM admins WHERE email = :email";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':email', $email);
        $stmt->execute();

        $admin = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($admin && password_verify($senha, $admin['senha'])) {
            $_SESSION['admin_logado'] = true;
            $_SESSION['admin_id'] = $admin['id'];
            $_SESSION['admin_nome'] = $admin['nome'];
            header('Location: index.php?page=dashboard&action=index');
            exit;
        }

        header('Location: index.php?page=auth&action=login&erro=1');
        exit;
    }

    public function logout()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        session_destroy();
        header('Location: index.php?page=auth&action=login');
        exit;
    }

    public static function verificarAcesso()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (empty($_SESSION['admin_logado'])) {
            header('Location: index.php?page=auth&action=login');
            exit;
        }
    }
}