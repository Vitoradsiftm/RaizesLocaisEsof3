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
  <title>Relatórios</title>
  <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
 <div class="container">
  <h2>Relatórios</h2>

  <div class="relatorio-botoes">
    <a href="relatorio_administracao.php" class="relatorio-btn">Pendente Gestão de Estoque</a>
    <a href="relatorio_logistica.php" class="relatorio-btn">Pendente logística</a>
  </div>

  <button onclick="history.back()" class="voltar-btn">← Voltar</button>
</div>
</body>
</html>
