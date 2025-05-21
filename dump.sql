
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

-- Dados iniciais existentes
INSERT INTO alunos (nome, data_nascimento, cpf, email, senha) VALUES
('Maria Rita', '1990-10-05', '123.456.789-00', 'maria@exemplo.com', '$2y$10$CzBQv6pm3mSY4DAZf/fxLOqxFV7oq7Qm/YzTq1z4HZ1M2taMGPH7a');

INSERT INTO turmas (nome, descricao) VALUES
('Turma A', 'Turma de introdução'),
('Turma B', 'Turma de desenvolvimento');

INSERT INTO matriculas (aluno_id, turma_id) VALUES
(1, 1);

INSERT INTO admins (nome, email, senha) VALUES
('Administrador FIAP', 'admin@fiap.com.br', '$2y$10$1qczTvkaGfbyiwSl66NAi.lLgKM1HkVjqY4LnbRBzW4ftno7XEMLi');

-- Dados adicionais para alunos
INSERT INTO alunos (nome, data_nascimento, cpf, email, senha) VALUES
('Maria Alice da Cruz', '2004-06-12', '223.599.234-04', 'gmoreira@gmail.com', '$2b$12$Fnrorhja1fKDZOAKzrmNZOKyh.ihpHM.HkW1yDnweD.lTnDu9XFkO'),
('Maria Julia Correia', '1994-04-07', '879.359.122-54', 'ceciliasales@goncalves.net', '$2b$12$1dEr8XEUO8.6TUoB32lQA.wREM4Js.duGGa.q7vrBSiyNgEXaGQ9.'),
('Daniela Campos', '2000-02-07', '815.286.494-35', 'costelalucca@rodrigues.net', '$2b$12$ZNuS4TY0YHr1dsY8ojErG.b/hsCmfQVuXslq8Xs1jqKmJSkhpfIy6'),
('Lucas Pires', '1994-09-14', '973.651.075-10', 'felipe23@fernandes.br', '$2b$12$Q5EsRYs7arwvRL0UOS9mmOLvAGQKjnXCXAeumh0/4m2qrpnzo5Jty'),
('Joaquim Duarte', '1992-08-10', '718.991.395-59', 'nathan89@hotmail.com', '$2b$12$FVLN0ylSHd0KeJnOpoMOuOCNTHpYr/Rv.dn9mNCW30FqQ7bDaDHd2'),
('Levi Lima', '1989-07-15', '228.218.347-99', 'ana-beatrizaraujo@yahoo.com.br', '$2b$12$o4aMrzfIrKK/3zYgwbhZcO6qTMiPOwmF1v2jaDaxGD2ZSS4UNgxTC'),
('Ian Ribeiro', '1995-08-06', '457.266.326-21', 'qcastro@uol.com.br', '$2b$12$1k1HKnAEjMaNp3uElN1QLOcEDt4jcAQXmIOxez8AbNwADK6yglFw.'),
('Sr. Gustavo Aragão', '1997-01-25', '582.374.928-70', 'julianascimento@monteiro.br', '$2b$12$r0f5nPJcTH4imavBM6KDR.Xn72I1myKvZjsDRnJuQGpt6dmB/sfvu'),
('Laís Jesus', '1990-08-28', '451.874.127-79', 'da-matamaite@bol.com.br', '$2b$12$aikzJ0yltixorLJ/xsGliOw4V4DwB7jGxfh1HEq/hS6kR5ot2VuKq'),
('Mariane Mendes', '2004-04-30', '471.379.887-84', 'mourajuan@hotmail.com', '$2b$12$KIVVNmeucBoQIPophYfiWuaUsLAe.mKbelXAi/ww5kxWVET1.0eZK'),
('Calebe Moura', '1990-06-17', '932.607.291-60', 'pedro73@uol.com.br', '$2b$12$dJ5NU9IWuLpZiuOoxz4dTuujPhIdS27xEIKI7pgdW.umMs3XsuULK'),
('Thiago da Paz', '1994-07-28', '657.090.080-36', 'wmoura@da.com', '$2b$12$Jzmjwj2Rhx4E5JUK5Nyut.P.6fMqsxaWyYQ7dD4ITBEaxKLL4DS1q'),
('Isabelly Fernandes', '2006-09-27', '440.627.092-28', 'samuel08@freitas.org', '$2b$12$qIyrSlLe5Imp4lOo97bg1uSUJhSeueQ3r95TticP0n8DnJ1yW0Ioa'),
('Dr. Lucas Gabriel Freitas', '1998-07-19', '059.278.446-00', 'xjesus@teixeira.br', '$2b$12$sHAATF0X0KMPNBLkjqk9m.itjsb5w1DuOEK0DUtyJhYLjhu8RJBqK'),
('Raul Pires', '2007-05-15', '959.050.026-90', 'nfarias@bol.com.br', '$2b$12$q0JE6Je9VLA5Cc.U9J17QuV.DOWyy8kV2CSqYT35Ws7.QgVPnoySW'),
('Davi Lucas Almeida', '1997-08-14', '767.930.812-84', 'ana-beatriz31@barros.org', '$2b$12$raH1F.N96GMkG8tN6HYcneBVgq09c7JaDC.PcRyMRweOOm6qt7C0q'),
('Dr. Eduardo Vieira', '1990-12-12', '854.743.351-13', 'das-neveskevin@yahoo.com.br', '$2b$12$LbjsRvKfZzEWdVvncLJyxeEg97GpKDhDRTzhUk6YYDCtA8lNlvvm.'),
('Daniela da Mota', '2005-09-24', '641.346.101-25', 'vicente54@duarte.net', '$2b$12$o8wTZoVZ28hxThQJpHa8h.5H1vbK/kbkvpCpmm9KA/6zUDfD.y5TG'),
('Maysa Costela', '1998-06-04', '448.077.754-72', 'daniela82@uol.com.br', '$2b$12$hNFyLnnbqRQIp8toQZNBv.ni76Zrqmec2aMERp7dSxz6onkvTNU5e'),
('Yasmin Freitas', '1996-12-08', '541.477.870-10', 'lda-rocha@gmail.com', '$2b$12$OAd0QvrU3yoD99xg7vk.YOhZWg66jyMVfpivYIOdHlYPf/uGi9yLS');

-- Dados adicionais para admins
INSERT INTO admins (nome, email, senha) VALUES
('Dra. Ana Laura Correia', '.ana.laura.correia@fiap.com.br', '$2b$12$IGRVJg9AzjbiKFQ79Ynoo.ah8ehfwCX4rzErtKWN1RhRjDHiv3ikO'),
('Ana Sophia das Neves', 'ana.sophia.das.neves@fiap.com.br', '$2b$12$/a/y2LRoe/w2RMpJCRVJTuVjfRiEO.06bGN.6oTTQID6TNjLvc5FG'),
('Nathan Fogaça', 'nathan.fogaça@fiap.com.br', '$2b$12$9or7A5zEooLlZmBZ3PrmP.riG9MH8aDJmp9LlCNfiaSHipej4hv2.'),
('Sophie da Costa', 'sophie.da.costa@fiap.com.br', '$2b$12$4ghbwnlWYIpjiEPwDeBL3eJvOhZZoG.0tBupPNzSSB0SK77LazVxq'),
('Dra. Gabriela Gonçalves', '.gabriela.gonçalves@fiap.com.br', '$2b$12$SQuctfyq27gGsyazuG9AXeGxmcrcOkpPVq/t/ffp48XTX5oES/RWi'),
('Ana Sophia Cavalcanti', 'ana.sophia.cavalcanti@fiap.com.br', '$2b$12$LmLNTrwszRprIRutqkJckulerHi5V5z/3IyR9UggRVeKXHSaA5/AG'),
('Pedro Henrique Moraes', 'pedro.henrique.moraes@fiap.com.br', '$2b$12$oO0YPFAfqNxYR9P4FHRa2u1afXOL.GTHlmrmKlx9pCtE1qXSTHRm6'),
('Alexia Moura', 'alexia.moura@fiap.com.br', '$2b$12$1utYvkXmL9eqjx1EPfF0LegInUVCtVHkXPLrddq5SFXdMcXAhOqEW'),
('Emanuel Nunes', 'emanuel.nunes@fiap.com.br', '$2b$12$bnm0M72Jndp7yVTlttoF5exlywIvXcvc/HgygfsyLATdl0chps6sW'),
('Raul Araújo', 'raul.araújo@fiap.com.br', '$2b$12$fvAp.sG4CvI7pivgp4kFOuFqr22p2DdTTYItpOQqxhv3SMBJodZXW'),
('Catarina Melo', 'catarina.melo@fiap.com.br', '$2b$12$.sBUUTBQC6sb/ihH0YW8fO8TRV0Pg2sjODMd1zjYNJOlEf7mEb7h2'),
('João Almeida', 'joão.almeida@fiap.com.br', '$2b$12$hYpbKl8H2N8.f1CgGwNaiOrMe6CGWov3DmHsIlxxYCQ28vVhCOJ3K'),
('Pietro Dias', 'pietro.dias@fiap.com.br', '$2b$12$ebfsVolytpFY4kcF1gM37.OGQ8HuAIdyv.xx4QzWNtWTX7UBnMuYO'),
('João Felipe Nascimento', 'joão.felipe.nascimento@fiap.com.br', '$2b$12$XauPonJXjoX5rNe.E5VVEuHkTRW0KQA8V6r295WfD9M6ZX/iWdOe6'),
('Dra. Alice Oliveira', '.alice.oliveira@fiap.com.br', '$2b$12$aJIVlqFdM5UocmY4v5qwCucmyrd6lzrUAudekxyFXhAffrw6WiZO.');

-- Dados adicionais para turmas
INSERT INTO turmas (nome, descricao) VALUES
('Introdução à Programação', 'Fundamentos de lógica e algoritmos usando linguagens básicas como Python ou C.'),
('Estrutura de Dados', 'Implementação de listas, pilhas, filas e árvores em linguagens de programação.'),
('Banco de Dados I', 'Modelagem relacional, normalização e SQL básico a avançado.'),
('Desenvolvimento Web', 'Criação de aplicações web com HTML, CSS, JavaScript e frameworks modernos.'),
('Engenharia de Software', 'Processos, requisitos, modelagem e testes no ciclo de desenvolvimento de software.'),
('Sistemas Operacionais', 'Funcionamento interno dos sistemas operacionais, gerenciamento de processos e memória.'),
('Redes de Computadores', 'Princípios de comunicação de dados, protocolos e configuração de redes.'),
('Programação Orientada a Objetos', 'Aplicação dos conceitos de classe, herança e encapsulamento com Java ou PHP.'),
('Algoritmos e Lógica', 'Desenvolvimento de algoritmos eficientes e resolução de problemas computacionais.'),
('Banco de Dados II', 'SQL avançado, stored procedures e administração de bancos de dados.'),
('Desenvolvimento Mobile', 'Criação de apps híbridos e nativos com foco em usabilidade e desempenho.'),
('Inteligência Artificial', 'Fundamentos de machine learning, redes neurais e algoritmos preditivos.'),
('Segurança da Informação', 'Práticas e estratégias para proteger sistemas contra ataques e vulnerabilidades.'),
('Arquitetura de Computadores', 'Estudo dos componentes internos de um computador e organização de hardware.'),
('Computação em Nuvem', 'Criação e gestão de aplicações na nuvem com AWS, Azure e Google Cloud.');

-- Dados adicionais para matriculas
INSERT INTO matriculas (aluno_id, turma_id) VALUES
(8, 3),
(2, 3),
(4, 4),
(2, 4),
(5, 5),
(5, 6),
(3, 7),
(2, 7),
(19, 7),
(21, 8),
(12, 9),
(4, 10),
(8, 10),
(14, 10),
(3, 11),
(20, 11),
(19, 11),
(19, 12),
(4, 13),
(3, 13),
(12, 13),
(9, 14),
(21, 15),
(13, 15),
(17, 15),
(17, 16),
(11, 17),
(13, 17);