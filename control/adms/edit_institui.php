
<?php
include"admprotect.php";

include('../conection.php');
?>

<?php

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM instituicao WHERE id_instituicao=?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $stmt->close();
}

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $instituicao = $_POST['instituicao'];
   
    // Update the entry
    $sqlUpdate = "UPDATE instituicao SET nome_instituicao=? WHERE id_instituicao=?";
    $stmtUpdate = $mysqli->prepare($sqlUpdate);
    $stmtUpdate->bind_param("si", $instituicao, $id);
    if ($stmtUpdate->execute()) {
        $stmtUpdate->close();
        header("Location: institui.php"); // Redirect after successful update
        exit();
    } else {
        echo "Error updating record: " . $stmtUpdate->error;
    }
}

$mysqli->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Instituição</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1>Edit Instituição</h1>

        <form method="post">
            <input type="hidden" name="id" value="<?php echo $row['id_instituicao']; ?>">
            <div class="form-group">
                <input type="text" name="instituicao" value="<?php echo $row['nome_instituicao']; ?>" class="form-control" placeholder="Nome da Instituição" required>
            </div>
            <button type="submit" name="update" class="btn btn-primary">Atualizar</button>
        </form>
    </div>
</body>
</html>
