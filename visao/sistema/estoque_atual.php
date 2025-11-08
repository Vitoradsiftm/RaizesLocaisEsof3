<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit;
}

include_once(__DIR__ . "/../../modelo/Produtos/produtosDAO.php");
include_once(__DIR__ . "/../../modelo/Entradas/EntradaDAO.php");
include_once(__DIR__ . "/../../modelo/Saidas/saidaDAO.php");

$usuario_id = $_SESSION['usuario_id'];

$produtoDAO = new ProdutoDAO();
$entradaDAO = new EntradaDAO();
$saidaDAO = new SaidaDAO();

$estoque = $produtoDAO->listarEstoque($usuario_id);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Estoque Atual</title>
  <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
  <button onclick="history.back()" class="voltar-btn">← Voltar</button>

  <div class="container">
    <h2>Estoque Atual</h2>

    <table>
      <tr>
        <th>Produto</th>
        <th>Quantidade</th>
        <th>Última Entrada</th>
        <th>Última Saída</th>
      </tr>
      <?php foreach ($estoque as $item): 
          $produto = $item['nome'];
          $saldo = $item['saldo'];

          $ultimaEntrada = $entradaDAO->ultimaEntrada($produto); // opcional: filtrar por usuário
          $ultimaSaida = $saidaDAO->ultimaSaida($produto);       // opcional: filtrar por usuário
      ?>
      <tr>
        <td><?= htmlspecialchars($produto) ?></td>
        <td><?= htmlspecialchars($saldo) ?> kg</td>
        <td><?= $ultimaEntrada ? date('d/m/Y', strtotime($ultimaEntrada)) : '—' ?></td>
        <td><?= $ultimaSaida ? date('d/m/Y', strtotime($ultimaSaida)) : '—' ?></td>
      </tr>
      <?php endforeach; ?>
    </table>
  </div>
</body>
</html>
