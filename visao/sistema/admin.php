<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Administração</title>
  <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
  <div class="container">
    <h2>Administração</h2>
    <nav>
      <a href="historico.php">Histórico</a>
      <a href="relatorios.php">Relatórios</a>
      <a href="criarConta.php">Cadastrar Usuário</a>
      <a href="produtos.php">Produtos
    </nav>
    <button onclick="history.back()" class="voltar-btn">← Voltar</button>
  </div>
</body>
</html>
