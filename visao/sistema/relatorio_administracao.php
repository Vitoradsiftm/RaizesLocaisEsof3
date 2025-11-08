<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit;
}

include_once(__DIR__ . "/../../modelo/Entradas/EntradaDAO.php");
include_once(__DIR__ . "/../../modelo/Saidas/saidaDAO.php");

$entradaDAO = new EntradaDAO();
$saidaDAO = new SaidaDAO();

// Buscar entradas e saídas com status 'pendente'
$entradasPendentes = $entradaDAO->listarPendentes();
$saidasPendentes = $saidaDAO->listarPendentes();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Relatório Administrativo</title>
  <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
  <button onclick="history.back()" class="voltar-btn">← Voltar</button>

  <div class="container">
    <h2>Pendente gestão de estoque</h2>
    <p>Solicitações pendentes de aprovação:</p>

    <!-- Entradas pendentes -->
    <h3>Entradas Pendentes</h3>
    <table>
      <tr>
        <th>ID</th>
        <th>Data</th>
        <th>Produto</th>
        <th>Quantidade</th>
        <th>Usuário</th>
      </tr>
      <?php foreach ($entradasPendentes as $entrada): ?>
      <tr>
        <td><?= $entrada['id_entrada'] ?></td>
        <td><?= date('d/m/Y', strtotime($entrada['data_registro'])) ?></td>
        <td><?= htmlspecialchars($entrada['produto']) ?></td>
        <td><?= htmlspecialchars($entrada['quantidade']) ?> kg</td>
        <td><?= $entrada['usuario_id'] ?></td>
      </tr>
      <?php endforeach; ?>
    </table>

    <!-- Saídas pendentes -->
    <h3>Saídas Pendentes</h3>
    <table>
      <tr>
        <th>ID</th>
        <th>Data</th>
        <th>Produto</th>
        <th>Quantidade</th>
        <th>Usuário</th>
      </tr>
      <?php foreach ($saidasPendentes as $saida): ?>
      <tr>
        <td><?= $saida['id_saida'] ?></td>
        <td><?= date('d/m/Y', strtotime($saida['data_saida'])) ?></td>
        <td><?= htmlspecialchars($saida['produto']) ?></td>
        <td><?= htmlspecialchars($saida['quantidade']) ?> kg</td>
        <td><?= $saida['usuario_id'] ?></td>
      </tr>
      <?php endforeach; ?>
    </table>
  </div>
</body>
</html>
