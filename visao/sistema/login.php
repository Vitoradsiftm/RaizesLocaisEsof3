<?php
// Tela de login do sistema
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Login - Sistema de Estoque Agrícola</title>
  <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
  <div class="container">
    <h2>Login</h2>
    <form action="../../controle/LoginController.php" method="post">
      <label for="usuario">Usuário:</label>
      <input type="text" id="usuario" name="usuario" required>

      <label for="senha">Senha:</label>
      <input type="password" id="senha" name="senha" required>
      <button type="submit">Entrar</button>
    </form>

    <p style="margin-top: 20px; text-align: center;">
      Ainda não tem uma conta? <a href="criarConta.php">Criar conta</a>
    </p>
  </div>
</body>
</html>
