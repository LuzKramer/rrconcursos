<?php
include "admprotect.php";
include "../conection.php";

// Excluir questão
if (isset($_GET["delete"])) {
    $idQuestaoExcluir = $_GET["delete"];

    // Verifique se $idQuestaoExcluir é um número inteiro válido
    if (filter_var($idQuestaoExcluir, FILTER_VALIDATE_INT)) {
        // Consulta SQL para obter o caminho da imagem
        $sqlSelect = "SELECT imagem FROM questoes WHERE id_questao=?";
        $stmtSelect = $mysqli->prepare($sqlSelect); // Changed '$conn' to '$mysqli'
        $stmtSelect->bind_param("i", $idQuestaoExcluir);
        $stmtSelect->execute();

        $resultSelect = $stmtSelect->get_result();

        if ($resultSelect->num_rows > 0) {
            $row = $resultSelect->fetch_assoc();
            $imgPath = "../" . $row["imagem"];

            // Verifique se o arquivo da imagem existe antes de tentar excluí-lo
            if (file_exists($imgPath)) {
                // Delete the image file
                unlink($imgPath);
            }
        }

        // Excluir questão e suas respostas
        $queryExcluirRespostas = "DELETE FROM alternativas WHERE id_questao = $idQuestaoExcluir";
        $queryExcluirQuestao = "DELETE FROM questoes WHERE id_questao = $idQuestaoExcluir";

        if ($mysqli->query($queryExcluirRespostas) === TRUE && $mysqli->query($queryExcluirQuestao) === TRUE) {
            echo "Questão excluída com sucesso.";
        } else {
            echo "Erro ao excluir a questão: " . $mysqli->error; // Changed '$conn' to '$mysqli'
        }
    } else {
        echo "ID de questão inválido.";
    }
}

// Buscar todas as questões com nomes de disciplinas e instituições
$queryBuscarQuestoes = "SELECT q.id_questao, d.nome_disciplina, i.nome_instituicao, q.enunciado FROM questoes q
                        INNER JOIN disciplinas d ON q.id_disciplina = d.id_disciplina
                        INNER JOIN instituicao i ON q.id_instituicao = i.id_instituicao";
$resultadoQuestoes = $mysqli->query($queryBuscarQuestoes);
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

<div class="container mt-5">
    <h2 class="mb-4">Gerenciar Questões</h2>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Disciplina</th>
                <th>Instituição</th>
                <th>Enunciado</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($row = $resultadoQuestoes->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["id_questao"] . "</td>";
                echo "<td>" . $row["nome_disciplina"] . "</td>";
                echo "<td>" . $row["nome_instituicao"] . "</td>";
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
