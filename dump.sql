-- Criação de todas as tabelas do sistema FIAP Secretaria

DROP TABLE IF EXISTS matriculas;
DROP TABLE IF EXISTS alunos;
DROP TABLE IF EXISTS turmas;
DROP TABLE IF EXISTS admins;

CREATE TABLE alunos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    data_nascimento DATE NOT NULL,
    cpf VARCHAR(14) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL,
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE turmas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    descricao TEXT NOT NULL,
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE matriculas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    aluno_id INT NOT NULL,
    turma_id INT NOT NULL,
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    UNIQUE (aluno_id, turma_id),
    FOREIGN KEY (aluno_id) REFERENCES alunos(id) ON DELETE CASCADE,
    FOREIGN KEY (turma_id) REFERENCES turmas(id) ON DELETE CASCADE
);

CREATE TABLE admins (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL,
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Dados iniciais
INSERT INTO alunos (nome, data_nascimento, cpf, email, senha) VALUES
('Maria Rita', '1990-10-05', '123.456.789-00', 'maria@exemplo.com', '$2y$10$CzBQv6pm3mSY4DAZf/fxLOqxFV7oq7Qm/YzTq1z4HZ1M2taMGPH7a');

INSERT INTO turmas (nome, descricao) VALUES
('Turma A', 'Turma de introdução'),
('Turma B', 'Turma de desenvolvimento');

INSERT INTO matriculas (aluno_id, turma_id) VALUES
(1, 1);

INSERT INTO admins (nome, email, senha) VALUES
('Administrador FIAP', 'admin@fiap.com.br', '$2y$10$1qczTvkaGfbyiwSl66NAi.lLgKM1HkVjqY4LnbRBzW4ftno7XEMLi');