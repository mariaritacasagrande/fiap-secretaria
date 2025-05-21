# FIAP Secretaria – Sistema de Gestão Acadêmica

Este sistema foi desenvolvido como parte do desafio técnico FIAP. A aplicação tem como objetivo permitir o gerenciamento de **alunos**, **turmas** e **matrículas** por parte de um administrador autenticado.

---

## Funcionalidades

- Autenticação de administradores (login/logout)
- CRUD completo de Alunos (com validação e segurança de senha)
- CRUD completo de Turmas (com contagem de alunos)
- Matrícula de alunos nas turmas (com validação de duplicidade)
- Filtros e busca por nome de aluno na matrícula
- Sistema de rotas e proteção por sessão
- Interface responsiva com Bootstrap 5
- Compatível com PHP 7.4+

---

## Tecnologias Utilizadas

- **PHP 7.4+** (sem frameworks)
- **MySQL** (dump incluído)
- **HTML5 / CSS3**
- **Bootstrap 5**
- Arquitetura **MVC** (Model-View-Controller)

---

## Estrutura de Pastas

```
fiap-secretaria/
├── config/             # Conexão com banco de dados (Database.php)
├── controllers/        # Controladores de cada entidade (Aluno, Turma, etc.)
├── models/             # Classes de modelo (representam entidades do BD)
├── views/              # Páginas HTML/PHP da aplicação
│   ├── alunos/
│   ├── turmas/
│   ├── matriculas/
│   ├── administradores/
│   └── templates/      # Cabeçalho, rodapé e menu
├── public/             # Arquivos públicos (index.php principal)
├── routes.php          # Arquivo de roteamento
├── dump.sql            # Script SQL com estrutura e dados
└── README.md
```

---

## Instalação Local

### 1. Clone o repositório

```bash
git clone https://github.com/seu-usuario/fiap-secretaria.git
cd fiap-secretaria
```

### 2. Configure o ambiente

- Instale o XAMPP ou outro servidor compatível com **PHP 7.4** e **MySQL**
- Copie o projeto para a pasta `htdocs` do XAMPP
- Crie um banco de dados com o nome `fiap_secretaria`
- Importe o arquivo `dump.sql` localizado na raiz do projeto via phpMyAdmin

### 3. Ajuste o arquivo de conexão

Abra o arquivo `config/Database.php` e ajuste as credenciais de acesso ao banco, se necessário:

```php
private $host = "localhost";
private $db_name = "fiap_secretaria";
private $username = "root";
private $password = "";
```

### 4. Acesse a aplicação

Inicie o servidor Apache e acesse via navegador:

```
http://localhost/fiap-secretaria/public/index.php
```

---

## Credenciais de Acesso

Para login inicial:

- **E-mail:** admin@fiap.com.br
- **Senha:** Admin@123

---

## Requisitos

- PHP 7.4 ou superior
- MySQL 5.7 ou superior
- Navegador moderno

---

## Observações Técnicas

- O projeto não utiliza frameworks externos.
- Todas as senhas são criptografadas com `password_hash()`.
- As rotas são gerenciadas manualmente via `routes.php`.
- Todas as funcionalidades foram testadas no XAMPP para Windows.

---

## Autor

Desenvolvido por Maria Rita como parte do processo seletivo da FIAP.
