<?php
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit;
}

// Define o nome do usuário com fallback
$nomeUsuario = $_SESSION['nome'] ?? $_SESSION['usuario'] ?? 'Usuário';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard - Sistema de Estoque Agrícola</title>
  <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
  <div class="container">
    <!-- Título -->
    <h2>Bem-vindo, <?= htmlspecialchars($nomeUsuario) ?>!</h2>

    <!-- Menu de navegação -->
    <nav class="menu">
      <a href="produtor.php">Área do Produtor</a>
      <a href="estoque.php">Gestão de Estoque</a>
      <a href="admin.php">Administração</a>
      <a href="logistica.php">Logística</a>
    </nav>

    <section>
      <p>Escolha uma área para continuar a gestão do estoque.</p>
    </section>
  </div>

  <button onclick="window.location.href='logout.php'" class="voltar-btn">← Sair</button>
</body>
</html>
