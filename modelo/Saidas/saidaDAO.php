<?php
include_once(__DIR__ . "/../ConnectionFactory.php");
include_once(__DIR__ . "/saidaClass.php");

class SaidaDAO {
    public function cadastrar($saida) {
        $con = new ConnectionFactory();
        $conn = $con->getConnection();
        $sql = $conn->prepare("INSERT INTO saidas (data_saida, produto, quantidade, status, usuario_id) VALUES (?, ?, ?, ?, ?)");
        $sql->execute([
            $saida->getDataSaida(),
            $saida->getProduto(),
            $saida->getQuantidade(),
            $saida->getStatus(),
            $saida->getUsuarioId()
        ]);
    }

    public function getEstoqueAtual($produto) {
        $con = new ConnectionFactory();
        $conn = $con->getConnection();

        $entrada = $conn->prepare("SELECT SUM(quantidade) FROM entradas WHERE produto = ?");
        $entrada->execute([$produto]);
        $totalEntrada = $entrada->fetchColumn();

        $saida = $conn->prepare("SELECT SUM(quantidade) FROM saidas WHERE produto = ?");
        $saida->execute([$produto]);
        $totalSaida = $saida->fetchColumn();

        return ($totalEntrada ?: 0) - ($totalSaida ?: 0);
    }

    public function listar() {
        $con = new ConnectionFactory();
        $conn = $con->getConnection();
        $sql = $conn->query("SELECT * FROM saidas ORDER BY id_saida DESC");
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public function listarPendentes() {
        $con = new ConnectionFactory();
        $conn = $con->getConnection();
        $sql = $conn->query("SELECT * FROM saidas WHERE status = 'pendente'");
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public function listarPorUsuario($usuario_id) {
    $con = new ConnectionFactory();
    $conn = $con->getConnection();
    $sql = $conn->prepare("SELECT * FROM saidas WHERE usuario_id = ? ORDER BY data_saida DESC");
    $sql->execute([$usuario_id]);
    return $sql->fetchAll(PDO::FETCH_ASSOC);
}

    public function listarAprovadas() {
        $con = new ConnectionFactory();
        $conn = $con->getConnection();
        $sql = $conn->query("SELECT * FROM saidas WHERE status = 'aprovada'");
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarPorId($id) {
        $con = new ConnectionFactory();
        $conn = $con->getConnection();
        $sql = $conn->prepare("SELECT * FROM saidas WHERE id_saida = ?");
        $sql->execute([$id]);
        return $sql->fetch(PDO::FETCH_ASSOC);
    }

    public function atualizarStatus($id, $status) {
        $con = new ConnectionFactory();
        $conn = $con->getConnection();
        $sql = $conn->prepare("UPDATE saidas SET status = ? WHERE id_saida = ?");
        $sql->execute([$status, $id]);
    }

    public function ultimaSaida($produto) {
        $con = new ConnectionFactory();
        $conn = $con->getConnection();
        $sql = $conn->prepare("SELECT MAX(data_saida) FROM saidas WHERE produto = ?");
        $sql->execute([$produto]);
        return $sql->fetchColumn();
    }
}
?>
