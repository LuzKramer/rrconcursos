<?php
if (!isset($_SESSION)) {
    session_start();
}

if (!isset($_SESSION['nivel'])) {
    die("Você não pode acessar porque não está logado. <p><a href=\"../control/inout.php\">Clique aqui para fazer login</a></p>");
}
?>
