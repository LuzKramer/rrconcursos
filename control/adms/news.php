
<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_rrconcursos";

$conn = mysqli_connect($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Delete
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql = "DELETE FROM tb_news WHERE id=?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $title = $_POST['title'];
    $news = $_POST['news'];
    $date = date("Y-m-d");  // Use Y-m-d format for MySQL date

    if (isset($_FILES['img'])) {
        $img = $_FILES['img'];

        if ($img['error']){
            die("falha ao salvar imagem");
        }

        if ($img['size'] > 2097152){
            die("imagem mair que 2MB");
        }

        $pasta = "../../view/upnews/";
        $nomeImg = $img['name'];
        $newname =  uniqid();
        $extension = strtolower(pathinfo($nomeImg, PATHINFO_EXTENSION));

        if ($extension != "jpg" &&  $extension != "png" && $extension != "jpeg")
            die("tipe de arquivo invalido ");

        $path = $pasta . $newname . "." . $extension;

        $folder = "../view/upnews/";

        $save = $folder . $newname . "." . $extension;

        $bora = move_uploaded_file($img["tmp_name"], $path);
    }

    // Use prepared statements to prevent SQL injection
    $sql = "INSERT INTO tb_news (title, news, date, img) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ssss", $title, $news, $date, $save);

    if (mysqli_stmt_execute($stmt)) {
        echo "<script>alert('Noticia adicionada com sucesso!');</script>";
    } else {
        echo "<script>alert('Erro ao adicionar noticia!');</script>". mysqli_error($conn);
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
// hey mate what u r lookin' ?

?>
