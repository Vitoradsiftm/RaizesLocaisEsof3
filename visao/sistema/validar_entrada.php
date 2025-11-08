<?php
include_once(__DIR__ . "/../../modelo/Entradas/EntradaDAO.php");

$dao = new EntradaDAO();

// Processar ações de aprovação ou rejeição
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $acao = $_POST["acao"];

    if (in_array($acao, ['aprovada', 'rejeitada'])) {
        $dao->atualizarStatus($id, $acao);
    }
}

$pendentes = $dao->listarPendentes();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Validar Entrada</title>
  <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
  <button onclick="history.back()" class="voltar-btn">← Voltar</button>

  <div class="container">
    <h2>Entradas Pendentes</h2>

    <table>
      <thead>
        <tr>
          <th>Produto</th>
          <th>Quantidade</th>
          <th>Destino</th>
          <th>Data</th>
          <th>Ação</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($pendentes as $entrada): ?>
        <tr>
          <td><?= htmlspecialchars($entrada['produto']) ?></td>
          <td><?= htmlspecialchars($entrada['quantidade']) ?> kg</td>
          <td><?= htmlspecialchars($entrada['destino'] ?? '—') ?></td>
          <td>
            <?= isset($entrada['data_registro']) && strtotime($entrada['data_registro']) 
                ? date('d/m/Y', strtotime($entrada['data_registro'])) 
                : '—' ?>
          </td>
          <td>
            <form method="post" style="display:inline;">
              <input type="hidden" name="id" value="<?= $entrada['id_entrada'] ?>">
              <input type="hidden" name="acao" value="aprovada">
              <button class="aprovar">Aprovar</button>
            </form>
            <form method="post" style="display:inline;">
              <input type="hidden" name="id" value="<?= $entrada['id_entrada'] ?>">
              <input type="hidden" name="acao" value="rejeitada">
              <button class="negar">Negar</button>
            </form>
          </td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</body>
</html>
