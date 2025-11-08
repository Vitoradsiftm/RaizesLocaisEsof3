<?php
session_start();
include_once(__DIR__ . "/../../modelo/Saidas/saidaClass.php");
include_once(__DIR__ . "/../../modelo/Saidas/saidaDAO.php");
include_once(__DIR__ . "/../../modelo/Produtos/produtosDAO.php");

// Verifica se o usuário está logado
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit;
}

$dao = new SaidaDAO();
$produtoDAO = new ProdutoDAO();
$usuario_id = $_SESSION["usuario_id"];
$produtos = $produtoDAO->listarEstoque($usuario_id); // ✅ produtos do usuário
$mensagem = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = $_POST["data"];
    $produto = $_POST["produto"];
    $quantidade = $_POST["quantidade"];

    $saldoAtual = $produtoDAO->getSaldo($produto, $usuario_id);

    if ($quantidade > $saldoAtual) {
        $mensagem = "❌ Estoque insuficiente! Disponível: $saldoAtual";
    } else {
        $saida = new Saida();
        $saida->setDataSaida($data);
        $saida->setProduto($produto);
        $saida->setQuantidade($quantidade);
        $saida->setStatus("pendente");
        $saida->setUsuarioId($usuario_id);

        $dao->cadastrar($saida);

        $mensagem = "✅ Saída registrada com sucesso!";
    }
}

$saidas = $dao->listarPorUsuario($usuario_id); // ✅ filtra por usuário
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Saídas - Estoque</title>
  <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
  <div class="container">
    <h2>Registrar Saída</h2>
    <nav>
      <a href="dashboard.php">Dashboard</a>
      <a href="entradas.php">Entradas</a>
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

    <h3>Saídas Recentes</h3>
    <table>
      <tr>
        <th>Data</th>
        <th>Produto</th>
        <th>Qtd</th>
        <th>Status</th>
      </tr>
      <?php foreach ($saidas as $s): ?>
      <tr>
        <td><?= date('d/m/Y', strtotime($s['data_saida'])) ?></td>
        <td><?= htmlspecialchars($s['produto']) ?></td>
        <td><?= htmlspecialchars($s['quantidade']) ?> kg</td>
        <td><?= htmlspecialchars($s['status']) ?></td>
      </tr>
      <?php endforeach; ?>
    </table>
  </div>
</body>
</html>
