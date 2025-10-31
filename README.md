# 🌱 Raízes Locais — Sistema de Gestão de Produção Agrícola
Sistema web desenvolvido para auxiliar pequenos produtores na gestão de entradas e saídas de produtos agrícolas, controle de estoque, validação administrativa e execução logística. Este projeto foi desenvolvido como parte da Etapa 02 do Trabalho de Conclusão de Disciplina (TCD) da matéria Engenharia de Software III (ESOF 3).

📦 Requisitos do Ambiente
PHP 8.0 ou superior

MySQL 5.7 ou superior

Servidor Apache (recomendado: XAMPP)

Navegador moderno (Chrome, Firefox, Edge)

Python 3.11 (para testes automatizados com Selenium)

Composer (opcional, se usar bibliotecas PHP externas)

🔧 Instalação e Configuração
1. Clonar o projeto
git clone https://github.com/Vitoradsiftm/engenhariaDeSoftwate3

2. Configurar o ambiente local
Instale o XAMPP e inicie Apache + MySQL

Copie o projeto para C:\xampp\htdocs\raizesLocais

Crie o banco de dados no phpMyAdmin com o nome raizeslocais

Importe o arquivo raizeslocais.sql (disponível na pasta /bd/)

3. Configurar conexão com o banco
Edite o arquivo conexao.php:

php
$host = "localhost";
$user = "root";
$pass = "";
$db = "raizeslocais";
$conn = mysqli_connect($host, $user, $pass, $db);
📁 Estrutura do Projeto
Código
raizesLocais/
├── modelo/           # DAOs e lógica de negócio
├── visao/            # Interfaces do usuário (HTML/PHP)
│   ├── sistema/      # Telas protegidas por login
│   └── produtos/     # Cadastro e listagem de produtos
├── controle/         # Controladores e validações
├── css/              # Estilos visuais
├── bd/               # Script SQL do banco
├── tests/            # Testes automatizados com Selenium
├── conexao.php       # Conexão com o banco
└── README.md         # Este arquivo
🚀 Como Executar o Sistema
Acesse no navegador:

Código
http://localhost/raizesLocais/login.php
Faça login com um usuário cadastrado

Navegue pelas funcionalidades:

Cadastro de produtos

Registro de entradas e saídas

Relatórios administrativos e logísticos

Execução logística com validação de estoque

🧪 Testes Automatizados
Requisitos:
Python 3.11

Selenium

Instalar dependências:
bash
pip install selenium
Rodar testes:
cd tests/
python test_login.py
python test_cadastrar_produto.py
Os testes simulam ações reais no navegador, como login e cadastro de produtos.

✅ Boas Práticas Aplicadas
Modularização com DAOs e separação MVC

Versionamento com Git

Validação de dados e controle de sessão

Testes automatizados com Selenium

Layout responsivo e acessível

Comentários explicativos no código

👨‍💻 Equipe
Vitor Augusto Correia dos Reis


