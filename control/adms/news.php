

<?php
include"admprotect.php";

include('../conection.php');
?>

<?php

//delete
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    // Verifique se $id é um número inteiro válido
    if (filter_var($id, FILTER_VALIDATE_INT)) {
        $sqlSelect = "SELECT img FROM tb_news WHERE id=?";
        $stmtSelect = $mysqli->prepare($sqlSelect);
        $stmtSelect->bind_param("i", $id);
        $stmtSelect->execute();

        $resultSelect = $stmtSelect->get_result();

        if ($resultSelect->num_rows > 0) {
            $row = $resultSelect->fetch_assoc();
            $imgPath = "../" . $row["img"]; 

            // Verifique se o arquivo da imagem existe antes de tentar excluí-lo
            if (file_exists($imgPath)) {
                // Delete the image file
                unlink($imgPath);
            }

            $stmtSelect->close();

            $sqlDelete = "DELETE FROM tb_news WHERE id=?";
            $stmtDelete = $mysqli->prepare($sqlDelete);
            $stmtDelete->bind_param("i", $id);
            
            // Verifique se a exclusão do registro na tabela foi bem-sucedida
            if ($stmtDelete->execute()) {
                // A exclusão foi bem-sucedida
                echo "A imagem e o registro foram deletados com sucesso.";
            } else {
                // A exclusão do registro falhou
                echo "Erro ao deletar o registro na tabela.";
            }

            $stmtDelete->close();
        } else {
            echo "Registro não encontrado.";
        }
    } else {
        echo "ID inválido.";
    }
}



//add

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
            die("tipo de arquivo invalido ");

        $path = $pasta . $newname . "." . $extension;

        $folder = "../view/upnews/";

        $save = $folder . $newname . "." . $extension;

        $bora = move_uploaded_file($img["tmp_name"], $path);
    }

    // Use prepared statements to prevent SQL injection
    $sql = "INSERT INTO tb_news (title, news, date, img) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($mysqli, $sql);
    mysqli_stmt_bind_param($stmt, "ssss", $title, $news, $date, $save);

    if (mysqli_stmt_execute($stmt)) {
        echo "<script>alert('Noticia adicionada com sucesso!');</script>";
    } else {
        echo "<script>alert('Erro ao adicionar noticia!');</script>". mysqli_error($mysqli);
    }

    mysqli_stmt_close($stmt);
    mysqli_close($mysqli);
}
// hey mate what u r lookin' ?

?><!DOCTYPE html>
<html>
<head>
    <title>News CRUD</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .btn-danger {
            background-color: red;
        }
    </style>
</head>
<body>


<header class="d-flex justify-content-center py-3">
        <ul class="nav nav-pills">
            <li class="nav-item"><a href="../dashboard.php" class="nav-link active" aria-current="page">Dashboard</a></li>
           
        </ul>
    </header>
    <div class="container">
        <h1 class="mt-4">News CRUD</h1>

        <!-- Create form -->
        <h2 class="mt-4">Create News</h2>
        <form method="post" enctype="multipart/form-data">
            <div class="form-group">
                <input type="text" name="title" placeholder="Title" class="form-control" required>
            </div>
            <div class="form-group">
                <textarea name="news" placeholder="News" class="form-control" required></textarea>
            </div>
            <div class="form-group">
                <input type="file" name="img" class="form-control-file">
            </div>
            <button type="submit" name="create" class="btn btn-primary">Create</button>
        </form>

        <!-- Read data -->
        <h2 class="mt-4">News List</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Move this section outside the POST request block
                $sql = "SELECT * FROM tb_news";
                $result = $mysqli->query($sql);

                while ($row = $result->fetch_assoc()):
                ?>
                <tr>
                    <td><?php echo $row['title']; ?></td>
                    <td><?php echo $row['date']; ?></td>
                    <td>
                        <a href="edit_news.php?id=<?php echo $row['id']; ?>" class="btn btn-info btn-sm">Edit</a>
                        <a href="?delete=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm">Delete</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <!-- Include Bootstrap JS -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
