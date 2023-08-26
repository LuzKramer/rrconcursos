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

    $sql = "SELECT * FROM disciplinas WHERE id_disciplina=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $stmt->close();
}

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $disciplina = $_POST['disciplina'];
   
    // Update the entry
    $sqlUpdate = "UPDATE disciplinas SET nome_disciplina=? WHERE id_disciplina=?";
    $stmtUpdate = $conn->prepare($sqlUpdate);
    $stmtUpdate->bind_param("si", $disciplina, $id);
    if ($stmtUpdate->execute()) {
        $stmtUpdate->close();
        header("Location: disciplinas.php"); // Redirect after successful update
        exit();
    } else {
        echo "Error updating record: " . $stmtUpdate->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Discipline</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1>Edit Discipline</h1>

        <form method="post">
            <input type="hidden" name="id" value="<?php echo $row['id_disciplina']; ?>">
            <div class="form-group">
                <input type="text" name="disciplina" value="<?php echo $row['nome_disciplina']; ?>" class="form-control" placeholder="Title" required>
            </div>
            <button type="submit" name="update" class="btn btn-primary">Update</button>
        </form>
    </div>
</body>
</html>
