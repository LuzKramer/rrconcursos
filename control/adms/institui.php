
<?php
include"admprotect.php";
?>


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

    $sqlDelete = "DELETE FROM instituicao WHERE id_instituicao=?";
    $stmtDelete = $conn->prepare($sqlDelete);
    $stmtDelete->bind_param("i", $id);
    if ($stmtDelete->execute()) {
        $stmtDelete->close();
        header("Location: institui.php"); // Redirect after successful delete
        exit();
    } else {
        echo "Error deleting record: " . $stmtDelete->error;
    }
}

// Add
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $instituicao = $_POST['instituicao'];

    // Use prepared statements to prevent SQL injection
    $sqlInsert = "INSERT INTO instituicao (nome_instituicao) VALUES (?)";
    $stmtInsert = $conn->prepare($sqlInsert);
    $stmtInsert->bind_param("s", $instituicao);

    if ($stmtInsert->execute()) {
        $stmtInsert->close();
        echo "<script>alert('Instituição added successfully!');</script>";
    } else {
        echo "<script>alert('Error adding instituição: " . $stmtInsert->error . "');</script>";
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Instituições</title>
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
    <h1 class="mt-4">Instituições</h1>

    <h2 class="mt-4">Adicionar Instituição</h2>
    <form method="post" enctype="multipart/form-data">
        <div class="form-group">
            <input type="text" name="instituicao" placeholder="Nome da Instituição" class="form-control" required>
        </div>
        <button type="submit" name="create" class="btn btn-primary">Criar</button>
    </form>

    <h2 class="mt-4">Lista de Instituições</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Instituição</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sqlSelect = "SELECT * FROM instituicao";
            $result = $conn->query($sqlSelect);

            while ($row = $result->fetch_assoc()):
            ?>
            <tr>
                <td><?php echo $row['nome_instituicao']; ?></td>
                <td>
                    <a href="edit_institui.php?id=<?php echo $row['id_instituicao']; ?>" class="btn btn-info btn-sm">Editar</a>
                    <a href="?delete=<?php echo $row['id_instituicao']; ?>" class="btn btn-danger btn-sm">Excluir</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
