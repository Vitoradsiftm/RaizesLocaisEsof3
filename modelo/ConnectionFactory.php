<?php
class ConnectionFactory {
    private $con = null;
    private $dbType = "mysql";
    private $host = "localhost";
    private $user = "root";
    private $senha = "";
    private $db = "raizeslocais";
    private $persistente = false;

    public function __construct($persistente = false) {
        $this->persistente = $persistente;
    }

    public function getConnection() {
        try {
            $this->con = new PDO(
                "$this->dbType:host=$this->host;dbname=$this->db",
                $this->user,
                $this->senha,
                [
                    PDO::ATTR_PERSISTENT => $this->persistente,
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
                ]
            );
            return $this->con;
        } catch (PDOException $ex) {
            die("Erro ao conectar ao banco: " . $ex->getMessage());
        }
    }

    public function close() {
        $this->con = null;
    }
}
?>
