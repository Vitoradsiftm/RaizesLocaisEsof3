<?php
session_start();           // Inicia a sessão
session_unset();           // Limpa todas as variáveis da sessão
session_destroy();         // Encerra a sessão

header("Location: ../../visao/sistema/login.php"); // Redireciona para o login
exit;
?>
