<?php
// Exibe erros na tela para facilitar o debug
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit;
}

include_once(__DIR__ . "/../../modelo/Entradas/EntradaDAO.php");
include_once(__DIR__ . "/../../modelo/Saidas/saidaDAO.php");
include_once(__DIR__ . "/../../modelo/Produtos/produtosDAO.php");

$entradaDAO = new EntradaDAO();
$saidaDAO = new SaidaDAO();
$produtoDAO = new ProdutoDAO();
$mensagem = "";

$usuario_id = $_SESSION['usuario_id'];

// Processar execução logística
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tipo = $_POST["tipo"];
    $id = $_POST["id"];

    if ($tipo === "entrada") {
        $entrada = $entradaDAO->buscarPorId($id);
        $produto = $entrada['produto'];
        $quantidade = $entrada['quantidade'];

        $produtoDAO->atualizarSaldo($produto, $quantidade, $usuario_id, '+');
        $entradaDAO->atualizarStatus($id, 'executada');
        $mensagem = "✅ Entrada de <strong>$produto</strong> executada com sucesso!";
    }

    if ($tipo === "saida") {
        $saida = $saidaDAO->buscarPorId($id);
        $produto = $saida['produto'];
        $quantidade = $saida['quantidade'];
        $saldoAtual = $produtoDAO->getSaldo($produto, $usuario_id);

        if ($quantidade > $saldoAtual) {
            $mensagem = "❌ Estoque insuficiente para saída de <strong>$produto</strong>. Disponível: $saldoAtual kg";
        } else {
            $produtoDAO->atualizarSaldo($produto, $quantidade, $usuario_id, '-');
            $saidaDAO->atualizarStatus($id, 'executada');
            $mensagem = "✅ Saída de <strong>$produto</strong> executada com sucesso!";
        }
    }
}

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
  <title>Execução Logística</title>
  <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
  <button onclick="history.back()" class="voltar-btn">← Voltar</button>

  <div class="container">
    <h2>Execução Logística</h2>

    <?php if ($mensagem): ?>
      <p class="mensagem"><?= $mensagem ?></p>
    <?php endif; ?>

    <table>
      <thead>
        <tr>
          <th>Data</th>
          <th>Produto</th>
          <th>Quantidade</th>
          <th>Destino</th>
          <th>Tipo</th>
          <th>Ação</th>
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
          <td>
            <form method="post">
              <input type="hidden" name="id" value="<?= $e['id_entrada'] ?>">
              <input type="hidden" name="tipo" value="entrada">
              <button class="aprovar">Executar</button>
            </form>
          </td>
        </tr>
        <?php endforeach; ?>

        <?php foreach ($saidas as $s): ?>
        <tr class="<?= classData($s['data_saida']) ?>">
          <td><?= formatarData($s['data_saida']) ?></td>
          <td><?= htmlspecialchars($s['produto']) ?></td>
          <td><?= htmlspecialchars($s['quantidade']) ?> kg</td>
          <td><?= htmlspecialchars($s['destino'] ?? '—') ?></td>
          <td>Saída</td>
          <td>
            <form method="post">
              <input type="hidden" name="id" value="<?= $s['id_saida'] ?>">
              <input type="hidden" name="tipo" value="saida">
              <button class="aprovar">Executar</button>
            </form>
          </td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</body>
</html>
