<?php
if (!isset($_SESSION)) {
    session_start();
}

if (!isset($_SESSION['nivel'])) {
    echo '<div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); background-color: #f44336; padding: 20px; border-radius: 10px; text-align: center; font-family: Arial, sans-serif; box-shadow: 0px 0px 10px rgba(0,0,0,0.5);">
            <p style="font-size: 24px; color: #fff;">Você não pode acessar porque não está logado.</p>
            <p><a href="../control/login.php" style="text-decoration: none; color: #2196F3; font-size: 18px;">Clique aqui para fazer login</a></p>
          </div>';
    die();
}
?>
