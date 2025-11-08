<?php
class Saida {
    private $id;
    private $dataSaida;
    private $produto;
    private $quantidade;
    private $status;
    private $usuario_id;

    public function setId($id) { $this->id = $id; }
    public function getId() { return $this->id; }

    public function setDataSaida($data) { $this->dataSaida = $data; }
    public function getDataSaida() { return $this->dataSaida; }

    public function setProduto($produto) { $this->produto = $produto; }
    public function getProduto() { return $this->produto; }

    public function setQuantidade($quantidade) { $this->quantidade = $quantidade; }
    public function getQuantidade() { return $this->quantidade; }

    public function setStatus($status) { $this->status = $status; }
    public function getStatus() { return $this->status; }

    public function setUsuarioId($usuario_id) { $this->usuario_id = $usuario_id; }
    public function getUsuarioId() { return $this->usuario_id; }
}
?>
