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
  <title>Logística</title>
  <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
  <div class="container">
    <h2>Área de Logística</h2>
    <nav>
      <a href="checklist_movimentacoes.php">Movimentações</a>
      <a href="estoque_atual.php">Status do Estoque</a>
    </nav>
    <button onclick="history.back()" class="voltar-btn">← Voltar</button>
  </div>
</body>
</html>
