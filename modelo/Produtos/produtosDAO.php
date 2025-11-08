<?php
include_once(__DIR__ . "/../ConnectionFactory.php");

class ProdutoDAO {
    public function atualizarSaldo($produto, $quantidade, $usuario_id, $operacao = '+') {
        $con = new ConnectionFactory();
        $conn = $con->getConnection();

        // Verifica se o produto existe para este usuário
        $check = $conn->prepare("SELECT COUNT(*) FROM produtos WHERE nome = ? AND usuario_id = ?");
        $check->execute([$produto, $usuario_id]);

        if ($check->fetchColumn() == 0) {
            // Insere produto com saldo 0 para este usuário
            $insert = $conn->prepare("INSERT INTO produtos (nome, saldo, usuario_id) VALUES (?, 0, ?)");
            $insert->execute([$produto, $usuario_id]);
        }

        // Atualiza saldo com operação dinâmica
        if ($operacao === '+' || $operacao === '-') {
            $sql = $conn->prepare("UPDATE produtos SET saldo = saldo $operacao ? WHERE nome = ? AND usuario_id = ?");
            $sql->execute([$quantidade, $produto, $usuario_id]);
        } else {
            throw new Exception("Operação inválida: use '+' ou '-'.");
        }
    }

    public function getSaldo($produto, $usuario_id) {
        $con = new ConnectionFactory();
        $conn = $con->getConnection();

        $sql = $conn->prepare("SELECT saldo FROM produtos WHERE nome = ? AND usuario_id = ?");
        $sql->execute([$produto, $usuario_id]);
        return $sql->fetchColumn();
    }

    public function listarEstoque($usuario_id) {
        $con = new ConnectionFactory();
        $conn = $con->getConnection();

        $sql = $conn->prepare("SELECT nome, saldo FROM produtos WHERE usuario_id = ? ORDER BY nome");
        $sql->execute([$usuario_id]);
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public function editarProduto($nomeAntigo, $nomeNovo, $usuario_id) {
    $con = new ConnectionFactory();
    $conn = $con->getConnection();
    $sql = $conn->prepare("UPDATE produtos SET nome = ? WHERE nome = ? AND usuario_id = ?");
    $sql->execute([$nomeNovo, $nomeAntigo, $usuario_id]);
}

public function excluirProduto($nome, $usuario_id) {
    $con = new ConnectionFactory();
    $conn = $con->getConnection();
    $sql = $conn->prepare("DELETE FROM produtos WHERE nome = ? AND usuario_id = ?");
    $sql->execute([$nome, $usuario_id]);
}

}
?>
