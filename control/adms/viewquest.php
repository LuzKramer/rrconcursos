
<?php
include"admprotect.php";
?>



<!DOCTYPE html>
<html>
<head>
    <title>Gerenciar Questões</title>
    <!-- Add Bootstrap CSS link here -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<header class="d-flex justify-content-center py-3">
        <ul class="nav nav-pills">
            <li class="nav-item"><a href="../dashboard.php" class="nav-link active" aria-current="page">Dashboard</a></li>
            <li class="nav-item"><a href="add_quest.php" class="nav-link">Adicionar Questão</a></li>
           
        </ul>
    </header>
    <?php
    // Detalhes de conexão do banco de dados
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "db_rrconcursos";

    // Criar conexão
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificar conexão
    if ($conn->connect_error) {
        die("Conexão falhou: " . $conn->connect_error);
    }

    // Excluir questão
    if (isset($_GET["delete"])) {
        $idQuestaoExcluir = $_GET["delete"];
        
        // Excluir questão e suas respostas
        $queryExcluirRespostas = "DELETE FROM alternativas WHERE id_questao = $idQuestaoExcluir";
        $queryExcluirQuestao = "DELETE FROM questoes WHERE id_questao = $idQuestaoExcluir";

        if ($conn->query($queryExcluirRespostas) === TRUE && $conn->query($queryExcluirQuestao) === TRUE) {
            echo "Questão excluída com sucesso.";
        } else {
            echo "Erro ao excluir a questão: " . $conn->error;
        }
    }

    // Buscar todas as questões
    $queryBuscarQuestoes = "SELECT * FROM questoes";
    $resultadoQuestoes = $conn->query($queryBuscarQuestoes);
    ?>

<div class="container mt-5">
        <h2 class="mb-4">Gerenciar Questões</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Enunciado</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = $resultadoQuestoes->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["id_questao"] . "</td>";
                    echo "<td>" . $row["enunciado"] . "</td>";
                    echo "<td><a href='edit_quest.php?id=" . $row["id_questao"] . "' class='btn btn-primary btn-sm'>Editar</a> | ";
                    echo "<a href='?delete=" . $row["id_questao"] . "' class='btn btn-danger btn-sm'>Excluir</a></td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Add Bootstrap JS and jQuery scripts here -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
