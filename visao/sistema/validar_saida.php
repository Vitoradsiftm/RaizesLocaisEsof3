<?php
include_once(__DIR__ . "/../../modelo/Saidas/saidaDAO.php");

$dao = new SaidaDAO();
$mensagem = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $acao = $_POST["acao"];

    if (in_array($acao, ['aprovada', 'rejeitada'])) {
        $dao->atualizarStatus($id, $acao);
        $produto = $dao->buscarPorId($id)['produto'];

        if ($acao === 'aprovada') {
            $mensagem = "✅ Saída de <strong>$produto</strong> aprovada com sucesso!";
        } else {
            $mensagem = "🚫 Saída de <strong>$produto</strong> foi rejeitada.";
        }
    }
}

$pendentes = $dao->listarPendentes();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Validar Saída</title>
  <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
  <button onclick="history.back()" class="voltar-btn">← Voltar</button>

  <div class="container">
    <h2>Saídas Pendentes</h2>

    <?php if ($mensagem): ?>
      <p class="mensagem"><?= $mensagem ?></p>
    <?php endif; ?>

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
        <?php foreach ($pendentes as $saida): ?>
        <tr>
          <td><?= htmlspecialchars($saida['produto']) ?></td>
          <td><?= htmlspecialchars($saida['quantidade']) ?> kg</td>
          <td><?= htmlspecialchars($saida['destino'] ?? '—') ?></td>
          <td>
            <?= isset($saida['data_saida']) && strtotime($saida['data_saida']) 
                ? date('d/m/Y', strtotime($saida['data_saida'])) 
                : '—' ?>
          </td>
          <td>
            <form method="post" style="display:inline;">
              <input type="hidden" name="id" value="<?= $saida['id_saida'] ?>">
              <input type="hidden" name="acao" value="aprovada">
              <button class="aprovar">Aprovar</button>
            </form>
            <form method="post" style="display:inline;">
              <input type="hidden" name="id" value="<?= $saida['id_saida'] ?>">
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
