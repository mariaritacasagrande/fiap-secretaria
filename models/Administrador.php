<?php
// models/Administrador.php

function buscarTodosAdministradores()
{
    global $pdo;
    $sql = "SELECT * FROM administradores";
    $stmt = $pdo->query($sql);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function buscarAdministradorPorId($id)
{
    global $pdo;
    $sql = "SELECT * FROM administradores WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC); // pode retornar false
}

function criarAdministrador($nomeCompleto, $senha)
{
    global $pdo;
    $senhaHash = password_hash($senha, PASSWORD_DEFAULT);
    $sql = "INSERT INTO administradores (nome_completo, senha) VALUES (?, ?)";
    $stmt = $pdo->prepare($sql);
    return $stmt->execute([$nomeCompleto, $senhaHash]);
}

function atualizarAdministrador($id, $nomeCompleto, $senha = null)
{
    global $pdo;

    if ($senha) {
        $senhaHash = password_hash($senha, PASSWORD_DEFAULT);
        $sql = "UPDATE administradores SET nome_completo = ?, senha = ? WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute([$nomeCompleto, $senhaHash, $id]);
    } else {
        $sql = "UPDATE administradores SET nome_completo = ? WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute([$nomeCompleto, $id]);
    }
}

function excluirAdministrador($id)
{
    global $pdo;
    $sql = "DELETE FROM administradores WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    return $stmt->execute([$id]);
}
