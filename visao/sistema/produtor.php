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
  <title>Área do Produtor</title>
  <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
  <div class="container">
    <h2>Área do Produtor</h2>
    <nav>
      <a href="entradas.php">Registrar Entrada</a>
      <a href="saidas.php">Registrar Saída</a>
    </nav>
  </div>
  <button onclick="history.back()" class="voltar-btn">← Voltar</button>
</body>
</html>
