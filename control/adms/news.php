

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
    echo "<script>alert('NOticia adicionada com sucesso!');</script>";
} else {
    echo "<script>alert('erroao adicionar noticia!');</script>". mysqli_error($conn);
}


// Update
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $news = $_POST['news'];
    $date = $_POST['date'];
    $img = $_POST['img'];

    $sql = "UPDATE tb_news SET title='$title', news='$news', date='$date', img='$img' WHERE id=$id";
    $conn->query($sql);
}

// Delete
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql = "DELETE FROM tb_news WHERE id=$id";
    $conn->query($sql);
}


mysqli_stmt_close($stmt);
mysqli_close($conn);
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>News CRUD</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .btn-danger {
            backgroundcolor: red;
        }
    </style>
</head>
<body>
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
        $result = $conn->query($sql);

        while ($row = $result->fetch_assoc()):
        ?>
        <tr>
            <td><?php echo $row['title']; ?></td>
            <td><?php echo $row['date']; ?></td>
            <td>
                <a href="edit.php?id=<?php echo $row['id']; ?>" class="btn btn-info btn-sm">Edit</a>
                <a href="?delete=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this news item?')">Delete</a>
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