<?php

$user = 'root';
$password = '';
$db = 'db_rrconcursos';
$host = 'localhost';

$mysqli = new mysqli($host, $user, $password, $db);

if($mysqli->error){
    die("error to conect".$mysqli->error);
}




 ?>

<?php

$user = 'root';
$password = '';
$db = 'db_rrconcursos';
$host = 'localhost';

$conn= new mysqli($host, $user, $password, $db);

if($conn->error){
    die("error to conect".$conn->error);
}




 ?>


