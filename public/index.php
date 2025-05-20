<?php
// -----------------------------------------------------
// ARQUIVO PRINCIPAL DA APLICAÇÃO
// -----------------------------------------------------
// Este arquivo é o "front controller" da aplicação.
// Ele inicializa a aplicação, carrega as dependências,
// define configurações e delega o controle para o roteador.
// -----------------------------------------------------

// Habilita a exibição de erros em ambiente de desenvolvimento
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Define o diretório raiz (opcional, mas útil para caminhos absolutos)
define('BASE_PATH', dirname(__DIR__));

// 🔗 Inclui arquivos essenciais
require_once BASE_PATH . '/config/database.php';           // Conexão com o banco de dados
require_once BASE_PATH . '/models/Aluno.php';              // Modelo de Aluno
require_once BASE_PATH . '/controllers/AlunoController.php'; // Controlador de Aluno
require_once BASE_PATH . '/routes.php';                    // Roteador de URLs