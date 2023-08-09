<?php
session_start();

// Database connection details
$host = "localhost"; // Replace with your database host
$username = "root"; // Replace with your database username
$password = ""; // Replace with your database password
$dbname = "db_rrconcursos"; // Replace with your database name

// Create a connection to the database
$conexao = new mysqli($host, $username, $password, $dbname);

// Check if the connection was successful
if ($conexao->connect_error) {
    die("Failed to connect to MySQL: " . $conexao->connect_error);
}

// Function to add a new discipline to the database
function addDisciplina($conexao, $disciplina)
{
    $stmt = $conexao->prepare("INSERT INTO disciplinas (nome_disciplina) VALUES (?)");
    $stmt->bind_param("s", $disciplina);

    if ($stmt->execute()) {
        return true;
    } else {
        return false;
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <meta charset="UTF-8">
    <title>Administração</title>
    <link rel="stylesheet" href="style.css">
    <style>
        header {
            background-color: #f8f9fa;
        }

        body {
            background-color: #f2f2f2;
            padding: 20px;
        }

        .main {
            max-width: 500px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h1 {
            font-size: 24px;
            margin-bottom: 20px;
        }

        input[type="text"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            margin-bottom: 10px;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 12px 20px;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        .nav-pills .nav-link.active {
            background-color: #007bff;
            color: #fff;
        }

        .nav-pills .nav-link {
            color: #007bff;
        }

        .nav-pills .nav-link:hover {
            background-color: #e9f3ff;
        }
    </style>
</head>

<body>
    <header class="d-flex justify-content-center py-3">
        <ul class="nav nav-pills">
            <li class="nav-item"><a href="../dashboard.php" class="nav-link active" aria-current="page">Dashboard</a></li>
            <li class="nav-item"><a href="add_quest.php" class="nav-link">Adicionar Questão</a></li>
            <li class="nav-item"><a href="addbank.php" class="nav-link">Adicionar Banca</a></li>
            <li class="nav-item"><a href="add_institui.php" class="nav-link">Adicionar Instituição</a></li>
            <li class="nav-item"><a href="add_discip.php" class="nav-link">Adicionar Disciplina</a></li>
        </ul>
    </header>

    <div class="main">
        <form method="POST">
            <h1>Adicione uma disciplina</h1>
            <input type="text" size="255" name="disciplina" required>
            <input type="submit" value="Adicionar">
        </form>
    </div>

</body>

</html>

<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $disciplina = $_POST["disciplina"];

    if (addDisciplina($conexao, $disciplina)) {
        echo "<script>alert('Disciplina adicionada com sucesso!');</script>";
    } else {
        echo "<script>alert('Erro ao adicionar disciplina.');</script>";
    }
}
$conexao->close();
?>
