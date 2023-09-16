<?php
include "admprotect.php";
include "../conection.php";
?>

<!DOCTYPE html>
<html>
<head>
    <title>Editar Questões</title>
    <!-- Add Bootstrap CSS link here -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<?php

// Função para buscar dados da questão
function getDadosQuestao($conn, $idQuestao)
{
    $query = "SELECT * FROM questoes WHERE id_questao = $idQuestao";
    $result = $conn->query($query);
    return $result->fetch_assoc();
}

// Função para buscar dados das respostas
function getDadosRespostas($conn, $idQuestao)
{
    $query = "SELECT * FROM alternativas WHERE id_questao = $idQuestao";
    $result = $conn->query($query);
    return $result->fetch_assoc();
}

// Função para buscar disciplinas disponíveis
function getDisciplinas($conn)
{
    $query = "SELECT * FROM disciplinas";
    $result = $conn->query($query);
    $disciplinas = [];
    while ($row = $result->fetch_assoc()) {
        $disciplinas[] = $row;
    }
    return $disciplinas;
}

// Função para buscar instituições disponíveis
function getInstituicoes($conn)
{
    $query = "SELECT * FROM instituicao";
    $result = $conn->query($query);
    $instituicoes = [];
    while ($row = $result->fetch_assoc()) {
        $instituicoes[] = $row;
    }
    return $instituicoes;
}

// Atualizar dados da questão e respostas
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idQuestao = $_POST["id_questao"];
    $novoEnunciado = $_POST["novo_enunciado"];
    $novaDisciplina = $_POST["nova_disciplina"];
    $novaInstituicao = $_POST["nova_instituicao"];

    // Atualizar enunciado e informações de disciplina e instituição na tabela questoes
    $queryAtualizar = "UPDATE questoes SET enunciado = '$novoEnunciado', id_disciplina = '$novaDisciplina', id_instituicao = '$novaInstituicao' WHERE id_questao = $idQuestao";
    $mysqli->query($queryAtualizar);

    // Atualizar opções de respostas na tabela alternativas
    for ($i = 1; $i <= 5; $i++) {
        $novaAlt = $_POST["nova_alt" . $i];
        $queryAltAtualizar = "UPDATE alternativas SET txt_alt$i = '$novaAlt' WHERE id_questao = $idQuestao";
        $mysqli->query($queryAltAtualizar);
    }

    echo "<script>alert('Dados da questão e respostas atualizados com sucesso!')</script>";
    header("Location: add_quest.php");
    exit();
}

$idQuestao = $_GET["id"];
$dadosQuestao = getDadosQuestao($mysqli, $idQuestao);
$dadosRespostas = getDadosRespostas($mysqli, $idQuestao);
$disciplinas = getDisciplinas($mysqli);
$instituicoes = getInstituicoes($mysqli);
?>

<div class="container mt-5">
    <h2 class="mb-4">Editar Questão</h2>
    <form method="POST" action="">
        <input type="hidden" name="id_questao" value="<?php echo $idQuestao; ?>">
        <div class="form-group">
            <label for="novo_enunciado">Enunciado:</label>
            <textarea class="form-control" name="novo_enunciado" rows="4"><?php echo $dadosQuestao["enunciado"]; ?></textarea>
        </div>

        <div class="form-group">
            <label for="nova_disciplina">Disciplina:</label>
            <select class="form-control" name="nova_disciplina">
                <?php
                foreach ($disciplinas as $disciplina) {
                    echo '<option value="' . $disciplina["id_disciplina"] . '"';
                    if ($disciplina["id_disciplina"] == $dadosQuestao["id_disciplina"]) {
                        echo ' selected';
                    }
                    echo '>' . $disciplina["nome_disciplina"] . '</option>';
                }
                ?>
            </select>
        </div>

        <div class="form-group">
            <label for="nova_instituicao">Instituição:</label>
            <select class="form-control" name="nova_instituicao">
                <?php
                foreach ($instituicoes as $instituicao) {
                    echo '<option value="' . $instituicao["id_instituicao"] . '"';
                    if ($instituicao["id_instituicao"] == $dadosQuestao["id_instituicao"]) {
                        echo ' selected';
                    }
                    echo '>' . $instituicao["nome_instituicao"] . '</option>';
                }
                ?>
            </select>
        </div>

        <label>Opções de Respostas:</label><br>
        <?php
        for ($i = 1; $i <= 5; $i++) {
            echo '<div class="form-group">';
            echo '<input type="text" class="form-control" name="nova_alt' . $i . '" value="' . $dadosRespostas["txt_alt$i"] . '">';
            echo '</div>';
        }
        ?>
        <br>
        <button type="submit" class="btn btn-primary">Atualizar</button>
    </form>
</div>

<!-- Add Bootstrap JS and jQuery scripts here -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
