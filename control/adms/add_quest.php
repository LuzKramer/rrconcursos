<?php


include('../conection.php');
?>

<!DOCTYPE html>
<html>

<head>
    <title>Inserir Questão</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <meta charset="UTF-8">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f8f8;
            margin: 0;
            padding: 0;
        }

        h1 {
            text-align: center;
            color: #333;
            padding: 20px;
            background-color: #fff;
            border-bottom: 2px solid #ccc;
        }

        form {
            max-width: 500px;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ccc;
            background-color: #fff;
        }

        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
            color: #555;
        }

        textarea,
        select,
        input[type="text"],
        input[type="number"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>

<body>
    <header class="d-flex justify-content-center py-3">
        <ul class="nav nav-pills">
            <li class="nav-item"><a href="../dashboard.php" class="nav-link active" aria-current="page">Dashboard</a></li>
            <li class="nav-item"><a href="viewquest.php" class="nav-link">Questões</a></li>
        </ul>
    </header>
    <form method="post" enctype="multipart/form-data">
        <label for="imagem">Imagem (opcional):</label>
        <input type="file" name="imagem" id="imagem">

        <label for="pergunta">Pergunta:</label>
        <textarea name="pergunta" id="pergunta" rows="4" cols="50" required></textarea>

        <label for="banca">Banca:</label>
        <select name="banca" id="banca" required>
            <?php
            // Retrieve the bancas from the database
            $query_banca = "SELECT id_banca, nome_banca FROM bancas";
            $result_bancas = mysqli_query($mysqli, $query_banca);

            // Display the options for bancas
            while ($row_banca = mysqli_fetch_assoc($result_bancas)) {
                echo '<option value="' . $row_banca['id_banca'] . '">' . $row_banca['nome_banca'] . '</option>';
            }

            // Close the result set
            mysqli_free_result($result_bancas);
            ?>
        </select>

        <label for="ano">Ano:</label>
        <input type="text" name="ano" id="ano"  maxlength="4"  pattern="\d{4}">


        <label for="instituicao">Instituição:</label>
        <select name="instituicao" id="instituicao" required>
            <?php
            // Retrieve the institutions from the database
            $query_instituicao = "SELECT id_instituicao, nome_instituicao FROM instituicao";
            $result_instituicao = mysqli_query($mysqli, $query_instituicao);

            // Display the options for institutions
            while ($row_instituicao = mysqli_fetch_assoc($result_instituicao)) {
                echo '<option value="' . $row_instituicao['id_instituicao'] . '">' . $row_instituicao['nome_instituicao'] . '</option>';
            }

            // Close the result set
            mysqli_free_result($result_instituicao);
            ?>
        </select>

        <label for="materia">Matéria:</label>
        <select name="materia" id="materia" required>
            <?php
            // Retrieve the disciplines from the database
            $query_disciplinas = "SELECT id_disciplina, nome_disciplina FROM disciplinas";
            $result_disciplinas = mysqli_query($mysqli, $query_disciplinas);

            // Display the options for disciplines
            while ($row_disciplina = mysqli_fetch_assoc($result_disciplinas)) {
                echo '<option value="' . $row_disciplina['id_disciplina'] . '">' . $row_disciplina['nome_disciplina'] . '</option>';
            }

            // Close the result set
            mysqli_free_result($result_disciplinas);
            ?>
        </select>

        <label for="opcao1">Opção 1:</label>
        <input type="text" name="opcao1" id="opcao1" required>

        <label for="opcao2">Opção 2:</label>
        <input type="text" name="opcao2" id="opcao2" required>

        <label for="opcao3">Opção 3:</label>
        <input type="text" name="opcao3" id="opcao3" required>

        <label for="opcao4">Opção 4:</label>
        <input type="text" name="opcao4" id="opcao4" required>

        <label for="opcao5">Opção 5:</label>
        <input type="text" name="opcao5" id="opcao5" required>

        <label for="resposta_correta">Resposta Correta (número da opção):</label>
        <input type="number" name="resposta_correta" id="resposta_correta" required>

        <input type="submit" value="Inserir Questão">
    </form>
</body>

</html>

<?php
// Verifica se o formulário foi enviado

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Obtém os dados do formulário
    $pergunta = $_POST["pergunta"];
    $banca = $_POST["banca"];
    $ano = $_POST["ano"];
    $instituicao = $_POST["instituicao"];
    $materia = $_POST["materia"];
    $opcao1 = $_POST["opcao1"];
    $opcao2 = $_POST["opcao2"];
    $opcao3 = $_POST["opcao3"];
    $opcao4 = $_POST["opcao4"];
    $opcao5 = $_POST["opcao5"];
    $resposta_correta = $_POST["resposta_correta"];

    $save = null; // Inicializa a variável de salvamento de imagem

    if (isset($_FILES['imagem']) && $_FILES['imagem']['size'] > 0) {
        $img = $_FILES['imagem'];

        if ($img['size'] > 2097152){
            die("Imagem maior que 2MB");
        }

        $pasta = "../../view/up/";
        $nomeImg = $img['name'];
        $newname = uniqid();
        $extension = strtolower(pathinfo($nomeImg, PATHINFO_EXTENSION));

        if ($extension != "jpg" && $extension != "png" && $extension != "jpeg") {
            die("Tipo de arquivo inválido");
        }

        $path = $pasta . $newname . "." . $extension;

        $folder = "../view/up/";

        $save = $folder . $newname . "." . $extension;

        $bora = move_uploaded_file($img["tmp_name"], $path);
    }

    $sql = "INSERT INTO questoes (id_disciplina, id_instituicao, ano, enunciado, imagem) 
            VALUES ('$materia', '$instituicao', '$ano', '$pergunta', '$save')";

    if (mysqli_query($mysqli, $sql)) {
        $questao_id = mysqli_insert_id($mysqli);

        $sql_alternativas = "INSERT INTO alternativas (id_questao, txt_alt1, txt_alt2, txt_alt3, txt_alt4, txt_alt5, correta) VALUES 
                             ($questao_id, '$opcao1', '$opcao2', '$opcao3', '$opcao4', '$opcao5', '$resposta_correta')";

        if (mysqli_query($mysqli, $sql_alternativas))  {
            echo "<script>alert('Questão adicionada com sucesso!');</script>";
        } else {
            echo "<script>alert('Erro ao adicionar questão.');</script>";
        }
    } else {
        echo "Erro ao inserir a questão: " . mysqli_error($mysqli);
    }

    mysqli_close($mysqli);
}

?>