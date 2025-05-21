<?php

require_once __DIR__ . '/../config/Database.php';
require_once __DIR__ . '/../models/Aluno.php';

echo "<h1>TESTES DO MODELO ALUNO</h1>";

// Instancia o modelo (a conexão é feita internamente)
$alunoModel = new Aluno();

// Teste 1: buscar aluno por ID
echo "<h2>Teste: buscarPorId(1)</h2>";
$aluno = $alunoModel->buscarPorId(1);

if ($aluno) {
    echo "Aluno encontrado: " . htmlspecialchars($aluno['nome']) . "<br>";
} else {
    echo "Nenhum aluno com ID 1 encontrado.<br>";
}

// Teste 2: listar todos os alunos
echo "<h2>Teste: listar()</h2>";
$alunos = $alunoModel->listar();

if (!empty($alunos)) {
    echo "Total de alunos encontrados: " . count($alunos) . "<br>";
    echo "<ul>";
    foreach ($alunos as $a) {
        echo "<li>" . htmlspecialchars($a['nome']) . " (" . htmlspecialchars($a['email']) . ")</li>";
    }
    echo "</ul>";
} else {
    echo "Nenhum aluno cadastrado.<br>";
}