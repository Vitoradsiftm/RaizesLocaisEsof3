<?php
class Entrada {
    private $id_entrada;
    private $dataRegistro;
    private $produto;
    private $quantidade;
    private $usuario_id;

    public function setIdEntrada($id) { $this->id_entrada = $id; }
    public function getIdEntrada() { return $this->id_entrada; }

    public function setDataRegistro($data) { $this->dataRegistro = $data; }
    public function getDataRegistro() { return $this->dataRegistro; }

    public function setProduto($produto) { $this->produto = $produto; }
    public function getProduto() { return $this->produto; }

    public function setQuantidade($quantidade) { $this->quantidade = $quantidade; }
    public function getQuantidade() { return $this->quantidade; }

    public function setUsuarioId($usuario_id) { $this->usuario_id = $usuario_id; }
    public function getUsuarioId() { return $this->usuario_id; }
}
?>
