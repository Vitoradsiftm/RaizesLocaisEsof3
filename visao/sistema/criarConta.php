<?php
include_once(__DIR__ . "/../../modelo/Usuario/Usuario.php");
include_once(__DIR__ . "/../../modelo/Usuario/UsuarioDAO.php");

$mensagem = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = trim($_POST["nome"]);
    $email = trim($_POST["email"]);
    $usuario = trim($_POST["usuario"]);
    $senha = $_POST["senha"];

    if (empty($nome) || empty($email) || empty($usuario) || empty($senha)) {
        $mensagem = "❌ Todos os campos são obrigatórios.";
    } else {
        $usuarioObj = new Usuario($nome, $email, $usuario, $senha);
        $dao = new UsuarioDAO();

        if ($dao->existeEmailOuUsuario($email, $usuario)) {
            $mensagem = "❌ Email ou usuário já cadastrados.";
        } else {
            $dao->cadastrar($usuarioObj);
            $mensagem = "✅ Conta criada com sucesso!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Criar Conta - Sistema de Estoque Agrícola</title>
  <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
  <div class="container">
    <h2>Criar Nova Conta</h2>

    <?php if ($mensagem): ?>
      <p class="mensagem"><?= $mensagem ?></p>
    <?php endif; ?>

    <form action="" method="post">
      <label for="nome">Nome completo:</label>
      <input type="text" id="nome" name="nome" required>

      <label for="email">Email:</label>
      <input type="email" id="email" name="email" required>

      <label for="usuario">Usuário:</label>
      <input type="text" id="usuario" name="usuario" required>

      <label for="senha">Senha:</label>
      <input type="password" id="senha" name="senha" required>
      <button type="submit">Cadastrar</button>
    </form>

    <p style="margin-top: 20px; text-align: center;">
      Já tem uma conta? <a href="login.php">Voltar ao login</a>
    </p>
  </div>
  <button onclick="history.back()" class="voltar-btn">← Voltar</button>
</body>
</html>
