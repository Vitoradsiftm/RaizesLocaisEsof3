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

// Buscar entradas e saídas aprovadas pela administração e pendentes na logística
$entradas = $entradaDAO->listarAprovadas();
$saidas = $saidaDAO->listarAprovadas();

function formatarData($data) {
    return date('d/m/Y', strtotime($data));
}

function classData($data) {
    $hoje = date('Y-m-d');
    $dataFormatada = date('Y-m-d', strtotime($data));
    if ($dataFormatada < $hoje) return 'atrasada';
    if ($dataFormatada == $hoje) return 'hoje';
    return 'futura';
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Relatório Logística</title>
  <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
  <button onclick="history.back()" class="voltar-btn">← Voltar</button>

  <div class="container">
    <h2>Relatório Logística</h2>
    <p>Solicitações aprovadas pela administração e aguardando execução logística:</p>

    <table>
      <thead>
        <tr>
          <th>Data</th>
          <th>Produto</th>
          <th>Quantidade</th>
          <th>Destino</th>
          <th>Tipo</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($entradas as $e): ?>
        <tr class="<?= classData($e['data_registro']) ?>">
          <td><?= formatarData($e['data_registro']) ?></td>
          <td><?= htmlspecialchars($e['produto']) ?></td>
          <td><?= htmlspecialchars($e['quantidade']) ?> kg</td>
          <td><?= htmlspecialchars($e['destino'] ?? '—') ?></td>
          <td>Entrada</td>
        </tr>
        <?php endforeach; ?>

        <?php foreach ($saidas as $s): ?>
        <tr class="<?= classData($s['data_saida']) ?>">
          <td><?= formatarData($s['data_saida']) ?></td>
          <td><?= htmlspecialchars($s['produto']) ?></td>
          <td><?= htmlspecialchars($s['quantidade']) ?> kg</td>
          <td><?= htmlspecialchars($s['destino'] ?? '—') ?></td>
          <td>Saída</td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</body>
</html>
