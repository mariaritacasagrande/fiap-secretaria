# FIAP Secretaria - Sistema de Gestão Acadêmica

Este sistema foi desenvolvido como parte do desafio técnico FIAP. A aplicação tem como objetivo permitir o gerenciamento de **alunos**, **turmas**, **matrículas** por parte de um administrador autenticado.

## Funcionalidades

- Autenticação de administradores (login/logout)
- CRUD de alunos
- CRUD de turmas
- CRUD de administradores
- Matrícula de alunos em turmas
- Listagem de alunos por turma
- Proteção de rotas via autenticação
- Busca dinâmica por alunos (AJAX)

## Tecnologias Utilizadas

- PHP 7.4+ (sem frameworks)
- MySQL (dump incluído)
- HTML5 / CSS3
- Bootstrap 5
- Arquitetura MVC (Model-View-Controller)


## Estrutura de Pastas

```
fiap-secretaria/
│
├── config/                 # Conexão com o banco de dados (database.php)
├── controllers/            # Controladores responsáveis pela lógica de cada entidade
├── models/                 # Acesso e manipulação dos dados no banco
├── views/                  # Interfaces do sistema
│   ├── administradores/    # CRUD de administradores
│   ├── alunos/             # CRUD de alunos
│   ├── auth/               # Tela de login
│   ├── dashboard/          # Painel principal pós-login
│   ├── matriculas/         # Matrícula e listagem por turma
│   ├── turmas/             # CRUD de turmas
│   └── partials/           # Cabeçalho e rodapé comuns
├── public/                 # Entrada principal (index.php) e chamadas AJAX
├── testes/                 # Scripts de teste manual (testar_aluno.php)
├── routes.php              # Roteador central das páginas e ações
├── dump.sql                # Script SQL com estrutura e dados iniciais
└── README.md               # Este arquivo
```
## Requisitos

- PHP 7.4+
- MySQL 5.7+
- Servidor local (XAMPP, Laragon, etc.)

## Instalação Local

1. Clone o repositório:
   ```bash
   git clone https://github.com/seuusuario/fiap-secretaria.git
     ```

2. Configure o ambiente
- Instale o XAMPP ou outro servidor compatível com PHP 7.4 e MySQL
- Copie o projeto para a pasta htdocs do XAMPP

3. Importe o banco de dados:
- Acesse o `phpMyAdmin` ou o terminal MySQL.
- Crie o banco de dados com o nome `fiap_secretaria`.
- Importe o arquivo `dump.sql` contido no projeto.

4. Configure o acesso ao banco:
   Edite o arquivo `config/database.php` com suas credenciais locais:
   ```php
   private $host = "localhost";
   private $db_name = "fiap_secretaria";
   private $username = "root";
   private $password = "";
   ```

4. Acesse o sistema:
   - Abra o navegador e vá até `http://localhost/fiap-secretaria/public`

## Credenciais de Acesso inicial

- **Login:** `admin@fiap.com.br`
- **Senha:** `Admin@123` (já criptografada no dump)


## Segurança

- Autenticação de administradores com verificação de sessão
- Senhas armazenadas com `bcrypt`
- Proteção contra SQL Injection via `PDO` com `bindParam`

## 🧪 Testes Manuais

O projeto inclui um teste básico para validar o funcionamento do modelo `Aluno`.

### Como rodar o teste:

1. Acesse o navegador e vá para:
   ```
   http://localhost/fiap-secretaria/testes/testar_aluno.php
   ```

2. Esse teste cobre:
- Busca de aluno pelo ID 1
- Listagem completa de alunos cadastrados

### Importante:
- O teste utiliza o modelo real e o banco de dados configurado no projeto.
- Ideal para validação local antes de deploy ou integração.

##  Observações

- As datas de nascimento são armazenadas no formato ISO (`YYYY-MM-DD`) e exibidas como `DD-MM-AAAA`.
- O sistema foi desenvolvido como parte de um desafio técnico.

## Licença

© 2025 Maria Rita Casagrande - Todos os direitos reservados.