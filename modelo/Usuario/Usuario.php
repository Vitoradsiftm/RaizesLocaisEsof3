<?php
class Usuario {
    private $nome;
    private $email;
    private $usuario;
    private $senha;

    public function __construct($nome, $email, $usuario, $senha) {
        $this->nome = $nome;
        $this->email = $email;
        $this->usuario = $usuario;
        $this->senha = $senha;
    }

    public function getNome() { return $this->nome; }
    public function getEmail() { return $this->email; }
    public function getUsuario() { return $this->usuario; }
    public function getSenha() { return $this->senha; }
}
?>
