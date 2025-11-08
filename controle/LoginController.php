<?php
session_start();
include_once(__DIR__ . "/../modelo/Usuario/UsuarioDAO.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST["usuario"];
    $senha = $_POST["senha"];

    $dao = new UsuarioDAO();
    $dados = $dao->autenticar($usuario, $senha);

    if ($dados) {
        $_SESSION['usuario_id'] = $dados['id'];         // ID do usuário
        $_SESSION['usuario'] = $dados['usuario'];       // nome de login
        $_SESSION['nome'] = $dados['nome'];             // ✅ nome completo do usuário
        header("Location: ../visao/sistema/dashboard.php");
        exit;
    } else {
        header("Location: ../visao/sistema/login.php?erro=1");
        exit;
    }
}
?>
