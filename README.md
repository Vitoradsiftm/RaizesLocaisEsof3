

---

````markdown
# 🌱 Raízes Locais — Sistema de Gestão de Produção Agrícola

> 💡 *Sistema web voltado para pequenos produtores rurais, auxiliando na gestão de entradas e saídas de produtos agrícolas, controle de estoque, validação administrativa e execução logística.*

📘 Desenvolvido como parte da **Etapa 02 do Trabalho de Conclusão de Disciplina (TCD)** da matéria **Engenharia de Software III (ESOF 3)**.

---

## 🧩 Sumário

- [📦 Requisitos do Ambiente](#-requisitos-do-ambiente)
- [🔧 Instalação e Configuração](#-instalação-e-configuração)
- [📁 Estrutura do Projeto](#-estrutura-do-projeto)
- [🚀 Como Executar o Sistema](#-como-executar-o-sistema)
- [🧪 Testes Automatizados](#-testes-automatizados)
- [✅ Boas Práticas Aplicadas](#-boas-práticas-aplicadas)
- [👨‍💻 Equipe](#-equipe)
- [💚 Licença](#-licença)

---

## 📦 Requisitos do Ambiente

| Componente        | Versão mínima | Observação |
|-------------------|---------------|-------------|
| PHP               | 8.0           | Backend principal |
| MySQL             | 5.7           | Banco de dados relacional |
| Apache            | —             | Recomendado: XAMPP |
| Navegador         | —             | Chrome, Firefox ou Edge |
| Python            | 3.11          | Utilizado para testes automatizados (Selenium) |
| Composer          | Opcional      | Para gerenciamento de dependências PHP |

---

## 🔧 Instalação e Configuração

### 1️⃣ Clonar o repositório
```bash
git clone https://github.com/Vitoradsiftm/engenhariaDeSoftwate3
````

### 2️⃣ Configurar o ambiente local

1. Instale o **XAMPP** e inicie **Apache + MySQL**
2. Copie o projeto para:

   ```
   C:\xampp\htdocs\raizesLocais
   ```
3. Crie o banco de dados no **phpMyAdmin**:

   ```sql
   CREATE DATABASE raizeslocais;
   ```
4. Importe o arquivo SQL:

   ```
   /bd/raizeslocais.sql
   ```

### 3️⃣ Configurar a conexão com o banco

Edite o arquivo `conexao.php` conforme o exemplo:

```php
<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "raizeslocais";

$conn = mysqli_connect($host, $user, $pass, $db);
?>
```

---

## 📁 Estrutura do Projeto

```
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
```

---

## 🚀 Como Executar o Sistema

1. Acesse no navegador:

   ```
   http://localhost/raizesLocais/login.php
   ```

2. Faça login com um usuário cadastrado.

3. Navegue pelas funcionalidades:

   * 🧺 **Cadastro de produtos**
   * 📦 **Registro de entradas e saídas**
   * 📊 **Relatórios administrativos e logísticos**
   * 🚚 **Execução logística com validação de estoque**

---

## 🧪 Testes Automatizados

### ⚙️ Requisitos

* Python 3.11
* Selenium

### 📥 Instalar dependências

```bash
pip install selenium
```

### ▶️ Executar testes

```bash
cd tests/
python test_login.py
python test_cadastrar_produto.py
```

> 💬 Os testes simulam ações reais no navegador, garantindo o correto funcionamento das principais funcionalidades do sistema.

---

## ✅ Boas Práticas Aplicadas

✔️ **Arquitetura MVC (Model-View-Controller)**
✔️ **Modularização com DAOs e camadas bem definidas**
✔️ **Versionamento com Git e GitHub**
✔️ **Validação de dados e controle de sessão**
✔️ **Testes automatizados com Selenium**
✔️ **Layout responsivo e acessível**
✔️ **Comentários explicativos no código**

---

## 👨‍💻 Equipe

| Nome                               | Função                                 |
| ---------------------------------- | -------------------------------------- |
| **Vitor Augusto Correia dos Reis** | Desenvolvimento, testes e documentação |

---

## 💚 Licença

Este projeto foi desenvolvido para fins acadêmicos e está sob a licença **MIT**.
Sinta-se à vontade para estudar, modificar e aprimorar o código. 🌿

---

> *"Fortalecendo o campo com tecnologia e inovação."* 🌾
> **Raízes Locais** — Engenharia de Software III • IFTM

```

---

Deseja que eu adicione **badges visuais** no topo (como `PHP | MySQL | Selenium | MVC | MIT License`)? Isso deixa o README ainda mais bonito e profissional no GitHub.
```
