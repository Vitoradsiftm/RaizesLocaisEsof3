<?php
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit;
}

include_once(__DIR__ . "/../../modelo/ConnectionFactory.php");

$con = new ConnectionFactory();
$conn = $con->getConnection();

// Consulta combinada de entradas e saídas
$sql = $conn->query("
    SELECT data_registro AS data, produto, 'entrada' AS tipo, quantidade, status 
    FROM entradas 
    WHERE usuario_id = {$_SESSION['usuario_id']}

    UNION ALL

    SELECT data_saida AS data, produto, 'saida' AS tipo, quantidade, status 
    FROM saidas 
    WHERE usuario_id = {$_SESSION['usuario_id']}

    ORDER BY data DESC
");

$movimentacoes = $sql->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Histórico</title>
  <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
  <div class="container">
    <h2>Histórico de Movimentações</h2>
    <nav>
      <a href="dashboard.php">Dashboard</a>
      <a href="entradas.php">Entradas</a>
      <a href="saidas.php">Saídas</a>
    </nav>

    <table>
      <tr>
        <th>Data</th>
        <th>Produto</th>
        <th>Tipo</th>
        <th>Quantidade</th>
        <th>Status</th>
      </tr>
      <?php foreach ($movimentacoes as $mov): ?>
        <tr>
          <td><?= date('d/m/Y', strtotime($mov['data'])) ?></td>
          <td><?= htmlspecialchars($mov['produto']) ?></td>
          <td><?= htmlspecialchars($mov['tipo']) ?></td>
          <td><?= htmlspecialchars($mov['quantidade']) ?> kg</td>
          <td><?= htmlspecialchars($mov['status']) ?></td>
        </tr>
      <?php endforeach; ?>
    </table>

    <button onclick="history.back()" class="voltar-btn">← Voltar</button>
  </div>
</body>
</html>
