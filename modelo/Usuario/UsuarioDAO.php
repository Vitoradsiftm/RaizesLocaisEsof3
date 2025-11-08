<?php
include_once(__DIR__ . "/../ConnectionFactory.php");

class UsuarioDAO {
    public function cadastrar(Usuario $usuario) {
        $con = new ConnectionFactory();
        $conn = $con->getConnection();

        $sql = $conn->prepare("INSERT INTO usuarios (nome, email, usuario, senha) VALUES (?, ?, ?, ?)");
        $sql->execute([
            $usuario->getNome(),
            $usuario->getEmail(),
            $usuario->getUsuario(),
            password_hash($usuario->getSenha(), PASSWORD_DEFAULT)
        ]);
    }

    public function existeEmailOuUsuario($email, $usuario) {
        $con = new ConnectionFactory();
        $conn = $con->getConnection();

        $sql = $conn->prepare("SELECT COUNT(*) FROM usuarios WHERE email = ? OR usuario = ?");
        $sql->execute([$email, $usuario]);
        return $sql->fetchColumn() > 0;
    }

    public function autenticar($usuario, $senha) {
        $con = new ConnectionFactory();
        $conn = $con->getConnection();

        $sql = $conn->prepare("SELECT id, usuario, senha FROM usuarios WHERE usuario = ?");
        $sql->execute([$usuario]);
        $dados = $sql->fetch(PDO::FETCH_ASSOC);

        if ($dados && password_verify($senha, $dados['senha'])) {
            return $dados;
        }

        return false;
    }
}
?>
