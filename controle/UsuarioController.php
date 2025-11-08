<?php
include_once(__DIR__ . "/../modelo/Usuario/Usuario.php");
include_once(__DIR__ . "/../modelo/Usuario/UsuarioDAO.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = trim($_POST["nome"]);
    $email = trim($_POST["email"]);
    $usuario = trim($_POST["usuario"]);
    $senha = $_POST["senha"];

    if (empty($nome) || empty($email) || empty($usuario) || empty($senha)) {
        echo "Todos os campos são obrigatórios.";
        exit;
    }

    $usuarioObj = new Usuario($nome, $email, $usuario, $senha);
    $dao = new UsuarioDAO();

    if ($dao->existeEmailOuUsuario($email, $usuario)) {
        echo "❌ Email ou usuário já cadastrados.";
    } else {
        $dao->cadastrar($usuarioObj);
        echo "✅ Conta criada com sucesso! <a href='../visao/login.php'>Ir para login</a>";
    }
} else {
    echo "Acesso inválido.";
}
?>
