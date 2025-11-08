<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit;
}

include_once(__DIR__ . "/../../modelo/Produtos/produtosDAO.php");

$produtoDAO = new ProdutoDAO();
$usuario_id = $_SESSION['usuario_id'];
$mensagem = "";
$modoEdicao = false;
$produtoEditado = "";

// Cadastro ou atualização
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['salvar'])) {
        $nome = trim($_POST["nome"]);
        $saldo = floatval($_POST["saldo"]);

        if (!empty($nome) && $saldo >= 0) {
            try {
                $produtoDAO->atualizarSaldo($nome, $saldo, $usuario_id, '+');
                $mensagem = "✅ Produto <strong>$nome</strong> registrado com saldo de $saldo kg.";
            } catch (Exception $e) {
                $mensagem = "❌ Erro: " . $e->getMessage();
            }
        } else {
            $mensagem = "⚠️ Preencha todos os campos corretamente.";
        }
    }

    if (isset($_POST['editar'])) {
        $produtoEditado = $_POST['editar'];
        $modoEdicao = true;
    }

    if (isset($_POST['atualizar'])) {
        $nomeAntigo = $_POST['nome_antigo'];
        $nomeNovo = trim($_POST['nome']);
        if (!empty($nomeNovo)) {
            $produtoDAO->editarProduto($nomeAntigo, $nomeNovo, $usuario_id);
            $mensagem = "✏️ Produto <strong>$nomeAntigo</strong> atualizado para <strong>$nomeNovo</strong>.";
        }
    }

    if (isset($_POST['excluir'])) {
        $nomeExcluir = $_POST['excluir'];
        $produtoDAO->excluirProduto($nomeExcluir, $usuario_id);
        $mensagem = "🗑️ Produto <strong>$nomeExcluir</strong> excluído com sucesso.";
    }
}

$estoque = $produtoDAO->listarEstoque($usuario_id);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Produtos</title>
  <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
  <div class="container">
    <h2>Produtos</h2>
    <nav>
      <a href="dashboard.php">Dashboard</a>
    </nav>

    <?php if ($mensagem): ?>
      <p class="mensagem"><?= $mensagem ?></p>
    <?php endif; ?>

    <form method="post">
      <?php if ($modoEdicao): ?>
        <input type="hidden" name="nome_antigo" value="<?= htmlspecialchars($produtoEditado) ?>">
        <label for="nome">Renomear Produto</label>
        <input type="text" id="nome" name="nome" value="<?= htmlspecialchars($produtoEditado) ?>" required>
        <button type="submit" name="atualizar">Atualizar Produto</button>
      <?php else: ?>
        <label for="nome">Novo Produto</label>
        <input type="text" id="nome" name="nome" required>

        <label for="saldo">Saldo Inicial (kg)</label>
        <input type="number" id="saldo" name="saldo" step="0.01" min="0" required>

        <button type="submit" name="salvar">Cadastrar Produto</button>
      <?php endif; ?>
    </form>

    <h3>Produtos Cadastrados</h3>
    <table>
      <tr>
        <th>Nome</th>
        <th>Saldo</th>
        <th>Ações</th>
      </tr>
      <?php foreach ($estoque as $item): ?>
      <tr>
        <td><?= htmlspecialchars($item['nome']) ?></td>
        <td><?= htmlspecialchars($item['saldo']) ?> kg</td>
        <td>
          <form method="post" style="display:inline;">
            <button type="submit" name="editar" value="<?= htmlspecialchars($item['nome']) ?>">✏️ Editar</button>
          </form>
          <form method="post" style="display:inline;" onsubmit="return confirm('Tem certeza que deseja excluir este produto?');">
            <button type="submit" name="excluir" value="<?= htmlspecialchars($item['nome']) ?>">🗑️ Excluir</button>
          </form>
        </td>
      </tr>
      <?php endforeach; ?>
    </table>
  </div>
  <button onclick="history.back()" class="voltar-btn">← Voltar</button>
</body>
</html>
