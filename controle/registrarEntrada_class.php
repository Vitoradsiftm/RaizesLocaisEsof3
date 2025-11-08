<?php
include_once(__DIR__ . "/../modelo/Entradas/entradaClass.php");
include_once(__DIR__ . "/../modelo/Entradas/EntradaDAO.php");

class CadastrarEntrada {
    // CONTROLE
    public function __construct() {

        if (isset($_POST["data"]) && isset($_POST["produto"]) && isset($_POST["quantidade"])) {
            // formulário foi enviado

            $e = new Entrada();
            $e->setDataRegistro($_POST["data"]);
            $e->setProduto($_POST["produto"]);
            $e->setQuantidade($_POST["quantidade"]);

            $dao = new EntradaDAO();
            $dao->cadastrar($e);

            $status = "Entrada do produto " . ucfirst($e->getProduto()) . " registrada com sucesso!";

            $lista = $dao->listar();

            include_once("visao/listaEntradas.php");

        } else {
            include_once("visao/formCadastroEntrada.php");
        }
    }
}
?>
