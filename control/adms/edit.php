<?php
// Database connection (same as in your previous code)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_rrconcursos";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM tb_news WHERE id=$id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
}

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $news = $_POST['news'];
    $date = $_POST['date'];
    $img = $_POST['img'];

    // Update the entry
    $sql = "UPDATE tb_news SET title='$title', news='$news', date='$date', img='$img' WHERE id=$id";
    $conn->query($sql);

    // Redirect to the news list after updating
    header("Location: news.php");
    exit();
}

$conn->close();
?>
<?php
// Database connection (same as in your previous code)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_rrconcursos";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM tb_news WHERE id=$id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
}

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $news = $_POST['news'];
    $date = $_POST['date'];
    $img = $_POST['img'];

    // Update the entry
    $sql = "UPDATE tb_news SET title='$title', news='$news', date='$date', img='$img' WHERE id=$id";
    $conn->query($sql);

    // Redirect to the news list after updating
    header("Location: news.php");
    exit();
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit News</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1>Edit News</h1>

        <form method="post">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
            <div class="form-group">
                <input type="text" name="title" value="<?php echo $row['title']; ?>" class="form-control" placeholder="Title" required>
            </div>
            <div class="form-group">
                <textarea name="news" class="form-control" placeholder="News" required><?php echo $row['news']; ?></textarea>
            </div>
            <div class="form-group">
                <input type="date" name="date" value="<?php echo $row['date']; ?>" class="form-control" required>
            </div>
            <div class="form-group">
                <input type="text" name="img" value="<?php echo $row['img']; ?>" class="form-control" placeholder="Image URL">
            </div>
            <button type="submit" name="update" class="btn btn-primary">Update</button>
        </form>
    </div>
</body>
</html>
