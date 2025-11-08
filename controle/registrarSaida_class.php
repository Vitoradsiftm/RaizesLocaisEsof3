<?php
include_once(__DIR__ . "/../modelo/Saidas/saidaClass.php");
include_once(__DIR__ . "/../modelo/Saidas/saidaDAO.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = $_POST["data"];
    $produto = $_POST["produto"];
    $quantidade = $_POST["quantidade"];

    $dao = new SaidaDAO();
    $estoqueAtual = $dao->getEstoqueAtual($produto);

    if ($quantidade > $estoqueAtual) {
        $mensagem = "❌ Estoque insuficiente! Disponível: $estoqueAtual";
    } else {
        $saida = new Saida();
        $saida->setDataSaida($data);
        $saida->setProduto($produto);
        $saida->setQuantidade($quantidade);
        $dao->cadastrar($saida);
        $mensagem = "✅ Saída registrada com sucesso!";
    }
}
?>
