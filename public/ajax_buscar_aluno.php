<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once realpath(__DIR__ . '/../config/Database.php');
require_once realpath(__DIR__ . '/../models/Aluno.php');

header('Content-Type: application/json');

if (!isset($_GET['nome']) || trim($_GET['nome']) === '') {
    echo json_encode([]);
    exit;
}

$nome = trim($_GET['nome']);
$model = new Aluno();
$resultados = $model->buscarPorNome($nome);

echo json_encode($resultados);