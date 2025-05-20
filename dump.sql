-- Criação do banco
CREATE DATABASE IF NOT EXISTS fiap_secretaria DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE fiap_secretaria;

-- Tabela de administradores
CREATE TABLE admins (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL,
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabela de alunos
CREATE TABLE alunos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    data_nascimento DATE NOT NULL,
    cpf VARCHAR(14) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL,
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabela de turmas
CREATE TABLE turmas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    descricao TEXT NOT NULL,
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabela de matrículas
CREATE TABLE matriculas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    aluno_id INT NOT NULL,
    turma_id INT NOT NULL,
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    UNIQUE KEY unica_matricula (aluno_id, turma_id),
    FOREIGN KEY (aluno_id) REFERENCES alunos(id) ON DELETE CASCADE,
    FOREIGN KEY (turma_id) REFERENCES turmas(id) ON DELETE CASCADE
);

-- Inserção de administrador padrão (senha = Admin@123)
INSERT INTO admins (nome, email, senha) VALUES (
    'Administrador FIAP', 
    'admin@fiap.com.br', 
    '$2y$10$nGuUtzGVBQLpOr5EdDBOmuNQ.A5rq0x6eYODTIuReNOUmfnZ1Qu5q'
);

-- Inserção de exemplo de aluno
INSERT INTO alunos (nome, data_nascimento, cpf, email, senha) VALUES (
    'Maria Rita',
    '1995-08-10',
    '123.456.789-00',
    'maria.rita@exemplo.com',
    '$2y$10$2RQPa3ADPIFPKrfV7aXYre2H7tAxr37nsDgSl2GHQfsKOB2XfiZkC'-- Senha: MariaRita123@123
);
 

-- Inserção de turma exemplo
INSERT INTO turmas (nome, descricao) VALUES (
    'Desenvolvimento Web I',
    'Turma voltada para aprendizado de HTML, CSS, JS e PHP básico.'
);

-- Matrícula exemplo
INSERT INTO matriculas (aluno_id, turma_id) VALUES (1, 1);
