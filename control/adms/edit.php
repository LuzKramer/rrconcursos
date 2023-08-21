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
</head>
<body>
    <h1>Edit News</h1>

    <form method="post">
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
        <input type="text" name="title" value="<?php echo $row['title']; ?>" placeholder="Title" required>
        <textarea name="news" placeholder="News" required><?php echo $row['news']; ?></textarea>
        <input type="date" name="date" value="<?php echo $row['date']; ?>" required>
        <input type="text" name="img" value="<?php echo $row['img']; ?>" placeholder="Image URL">
        <button type="submit" name="update">Update</button>
    </form>
</body>
</html>
