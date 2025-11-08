<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit;
}

include_once(__DIR__ . "/../../modelo/Entradas/entradaClass.php");
include_once(__DIR__ . "/../../modelo/Entradas/EntradaDAO.php");
include_once(__DIR__ . "/../../modelo/Produtos/produtosDAO.php");

$usuario_id = $_SESSION['usuario_id'];
$dao = new EntradaDAO();
$produtoDAO = new ProdutoDAO();
$produtos = $produtoDAO->listarEstoque($usuario_id);
$mensagem = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = $_POST["data"];
    $produto = $_POST["produto"];
    $quantidade = $_POST["quantidade"];

    if (!empty($data) && !empty($produto) && !empty($quantidade)) {
        $entrada = new Entrada();
        $entrada->setDataRegistro($data);
        $entrada->setProduto($produto);
        $entrada->setQuantidade($quantidade);
        $entrada->setUsuarioId($usuario_id);

        $dao->cadastrar($entrada);
        $mensagem = "✅ Entrada registrada com sucesso!";
    } else {
        $mensagem = "⚠️ Preencha todos os campos.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Entradas - Estoque</title>
  <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
  <div class="container">
    <h2>Registrar Entrada</h2>
    <nav>
      <a href="dashboard.php">Dashboard</a>
      <a href="saidas.php">Saídas</a>
    </nav>

    <?php if ($mensagem): ?>
      <p class="mensagem"><?= $mensagem ?></p>
    <?php endif; ?>

    <form action="" method="post">
      <label for="data">Data</label>
      <input type="date" id="data" name="data" required>

      <label for="produto">Produto</label>
      <select id="produto" name="produto" required>
        <option value="">Selecione um produto</option>
        <?php foreach ($produtos as $p): ?>
          <option value="<?= htmlspecialchars($p['nome']) ?>"><?= htmlspecialchars($p['nome']) ?></option>
        <?php endforeach; ?>
      </select>

      <label for="quantidade">Quantidade</label>
      <input type="number" id="quantidade" name="quantidade" step="0.01" required>

      <button type="submit">Salvar</button>
    </form>

    <h3>Solicitações Recentes</h3>
    <table>
      <tr>
        <th>Data</th>
        <th>Produto</th>
        <th>Qtd</th>
        <th>Status</th>
      </tr>
      <?php
      $entradas = $dao->listarPorUsuario($usuario_id);
      foreach ($entradas as $e) {
          echo "<tr>
                  <td>" . date('d/m/Y', strtotime($e['data_registro'])) . "</td>
                  <td>" . htmlspecialchars($e['produto']) . "</td>
                  <td>" . htmlspecialchars($e['quantidade']) . "</td>
                  <td>" . htmlspecialchars($e['status']) . "</td>
                </tr>";
      }
      ?>
    </table>
    <button onclick="history.back()" class="voltar-btn">← Voltar</button>
  </div>
</body>
</html>
