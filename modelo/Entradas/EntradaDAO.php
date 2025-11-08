<?php
include_once(__DIR__ . "/../ConnectionFactory.php");
include_once(__DIR__ . "/entradaClass.php");

class EntradaDAO {
    public function cadastrar($entrada) {
        try {
            $con = new ConnectionFactory();
            $conn = $con->getConnection();
            $sql = $conn->prepare("INSERT INTO entradas (data_registro, produto, quantidade, status, usuario_id) VALUES (?, ?, ?, ?, ?)");
            $sql->bindValue(1, $entrada->getDataRegistro());
            $sql->bindValue(2, $entrada->getProduto());
            $sql->bindValue(3, $entrada->getQuantidade());
            $sql->bindValue(4, 'pendente');
            $sql->bindValue(5, $entrada->getUsuarioId());
            $sql->execute();
        } catch (PDOException $e) {
            echo "Erro ao cadastrar entrada: " . $e->getMessage();
        }
    }

    public function listar() {
        $con = new ConnectionFactory();
        $conn = $con->getConnection();
        $sql = $conn->query("SELECT * FROM entradas ORDER BY id_entrada DESC");
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public function listarPorUsuario($usuario_id) {
        $con = new ConnectionFactory();
        $conn = $con->getConnection();
        $sql = $conn->prepare("SELECT * FROM entradas WHERE usuario_id = ? ORDER BY id_entrada DESC");
        $sql->execute([$usuario_id]);
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public function listarPendentes() {
        $con = new ConnectionFactory();
        $conn = $con->getConnection();
        $sql = $conn->query("SELECT * FROM entradas WHERE status = 'pendente'");
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public function atualizarStatus($id, $status) {
        $con = new ConnectionFactory();
        $conn = $con->getConnection();
        $sql = $conn->prepare("UPDATE entradas SET status = ? WHERE id_entrada = ?");
        $sql->execute([$status, $id]);
    }

    public function buscarPorId($id) {
        $con = new ConnectionFactory();
        $conn = $con->getConnection();
        $sql = $conn->prepare("SELECT * FROM entradas WHERE id_entrada = ?");
        $sql->execute([$id]);
        return $sql->fetch(PDO::FETCH_ASSOC);
    }

    public function ultimaEntrada($produto) {
        $con = new ConnectionFactory();
        $conn = $con->getConnection();
        $sql = $conn->prepare("SELECT MAX(data_registro) FROM entradas WHERE produto = ?");
        $sql->execute([$produto]);
        return $sql->fetchColumn();
    }

    public function listarAprovadas() {
        $con = new ConnectionFactory();
        $conn = $con->getConnection();
        $sql = $conn->query("SELECT * FROM entradas WHERE status = 'aprovada'");
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
