<?php
if (!isset($_SESSION)) {
    session_start();
}

if ($_SESSION['nivel']!==1 ) {
    die("Você não pode acessar porque não está logado. <p><a href=\"adms/admlogin.php\">Clique aqui para fazer login</a></p>");
}
?>
