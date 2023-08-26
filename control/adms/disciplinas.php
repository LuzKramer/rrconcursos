<?php
$user = 'root';
$password = '';
$db = 'db_rrconcursos';
$host = 'localhost';

$conn = new mysqli($host, $user, $password, $db);

if ($conn->connect_error) {
    die("Error to connect: " . $conn->connect_error);
}

// Delete
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    $sqlDelete = "DELETE FROM disciplinas WHERE id_disciplina=?";
    $stmtDelete = $conn->prepare($sqlDelete);
    $stmtDelete->bind_param("i", $id);
    if ($stmtDelete->execute()) {
        $stmtDelete->close();
        header("Location: disciplinas.php"); // Redirect after successful delete
        exit();
    } else {
        echo "Error deleting record: " . $stmtDelete->error;
    }
}

// Add
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $disciplina = $_POST['disciplina'];

    // Use prepared statements to prevent SQL injection
    $sqlInsert = "INSERT INTO disciplinas (nome_disciplina) VALUES (?)";
    $stmtInsert = $conn->prepare($sqlInsert);
    $stmtInsert->bind_param("s", $disciplina);

    if ($stmtInsert->execute()) {
        $stmtInsert->close();
        echo "<script>alert('Discipline added successfully!');</script>";
    } else {
        echo "<script>alert('Error adding discipline: " . $stmtInsert->error . "');</script>";
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Disciplinas</title>
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
    <h1 class="mt-4">Disciplinas</h1>

    <h2 class="mt-4">Add Discipline</h2>
    <form method="post" enctype="multipart/form-data">
        <div class="form-group">
            <input type="text" name="disciplina" placeholder="Title" class="form-control" required>
        </div>
        <button type="submit" name="create" class="btn btn-primary">Create</button>
    </form>

    <h2 class="mt-4">Discipline List</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Discipline</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sqlSelect = "SELECT * FROM disciplinas";
            $result = $conn->query($sqlSelect);

            while ($row = $result->fetch_assoc()):
            ?>
            <tr>
                <td><?php echo $row['nome_disciplina']; ?></td>
                <td>
                    <a href="edit_discip.php?id=<?php echo $row['id_disciplina']; ?>" class="btn btn-info btn-sm">Edit</a>
                    <a href="?delete=<?php echo $row['id_disciplina']; ?>" class="btn btn-danger btn-sm">Delete</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
