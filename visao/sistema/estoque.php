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
  <title>Gestão de Estoque</title>
  <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
  <div class="container">
    <h2>Gestão de Estoque</h2>
    <nav>
      <a href="validar_entrada.php">Validar Entrada</a>
      <a href="validar_saida.php">Validar Saída</a>
      <a href="estoque_atual.php">Estoque Atual</a>
    </nav>
    <button onclick="history.back()" class="voltar-btn">← Voltar</button>
  </div>
</body>
</html>
