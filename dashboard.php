<<!DOCTYPE html>
<html>
<head>
    <title>Inserir Questão</title>
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
    <h1>Inserir Questão</h1>
    <form method="post">
        <label for="pergunta">Pergunta:</label>
        <textarea name="pergunta" id="pergunta" rows="4" cols="50" required></textarea>

        <label for="banca">Banca:</label>
        <select name="banca" id="banca" required>
            <option value="fuvest">FUVEST</option>
            <option value="aaaaaa">aaaaaaa</option>
            <option value="banca3">Banca 3</option>
            <option value="banca4">Banca 4</option>
            <option value="banca5">Banca 5</option>
            <option value="banca6">Banca 6</option>
            <option value="banca7">Banca 7</option>
            <option value="banca8">Banca 8</option>
            <option value="banca9">Banca 9</option>
            <option value="banca10">Banca 10</option>
        </select>

        <label for="ano">Ano:</label>
        <input type="number" name="ano" id="ano" required>

        <label for="instituicao">Instituição:</label>
        <select name="instituicao" id="instituicao" required>
            <option value="inst1">UFRR</option>
            <option value="inst2">IFRR</option>
            <option value="inst3">UERR</option>
            <option value="inst4">ESTACIO</option>
        </select>

        <label for="materia">Matéria:</label>
<select name="materia" id="materia" required>
    <option value="">Selecione a Matéria</option>
    <option value="portugues">Português</option>
    <option value="matematica">Matemática</option>
    <option value="biologia">Biologia</option>
    <option value="quimica">Química</option>
    <option value="fisica">Física</option>
    <option value="historia">História</option>
    <option value="geografia">Geografia</option>
    <option value="ingles">Inglês</option>
    <option value="espanhol">Espanhol</option>
    <!-- Add more subjects as needed -->
</select>

        <label for="opcao1">Opção 1:</label>
        <input type="text" name="opcao1" id="opcao1" required>

        <label for="opcao2">Opção 2:</label>
        <input type="text" name="opcao2" id="opcao2" required>

        <label for="opcao3">Opção 3:</label>
        <input type="text" name="opcao3" id="opcao3" required>

        <label for="opcao4">Opção 4:</label>
        <input type="text" name="opcao4" id="opcao4" required>

        <label for="resposta_correta">Resposta Correta (número da opção):</label>
        <input type="number" name="resposta_correta" id="resposta_correta" required>

        <input type="submit" value="Inserir Questão">
    </form>
</body>
</html>




<?php
// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Obtain the form data
    $pergunta = $_POST["pergunta"];
    $banca = $_POST["banca"];
    $ano = $_POST["ano"];
    $instituicao = $_POST["instituicao"];
    $materia = $_POST["materia"];
    $opcao1 = $_POST["opcao1"];
    $opcao2 = $_POST["opcao2"];
    $opcao3 = $_POST["opcao3"];
    $opcao4 = $_POST["opcao4"];
    $resposta_correta = $_POST["resposta_correta"];

    // Database connection details
    $host = "localhost"; // Replace with your database host
    $username = "root"; // Replace with your database username
    $password = ""; // Replace with your database password
    $dbname = "db_rrconcursos"; // Replace with your database name

    // Create a connection to the database
    $conexao = mysqli_connect($host, $username, $password, $dbname);

    // Check if the connection was successful
    if (mysqli_connect_errno()) {
        die("Failed to connect to MySQL: " . mysqli_connect_error());
    }

    // Prepare and execute the SQL query to insert the question into the "questoes" table
    $sql = "INSERT INTO questoes (pergunta, banca, ano, instituicao, materia) 
            VALUES ('$pergunta', '$banca', '$ano', '$instituicao', '$materia')";

    if (mysqli_query($conexao, $sql)) {
        // Retrieve the ID of the newly inserted question
        $questao_id = mysqli_insert_id($conexao);

        // Prepare and execute the SQL query to insert the options into the "opcoes" table
        $sql_opcoes = "INSERT INTO opcoes (questao_id, descricao, correta) VALUES 
                       ($questao_id, '$opcao1', " . ($resposta_correta == 1 ? 1 : 0) . "),
                       ($questao_id, '$opcao2', " . ($resposta_correta == 2 ? 1 : 0) . "),
                       ($questao_id, '$opcao3', " . ($resposta_correta == 3 ? 1 : 0) . "),
                       ($questao_id, '$opcao4', " . ($resposta_correta == 4 ? 1 : 0) . ")";

        if (mysqli_query($conexao, $sql_opcoes)) {
            echo "Questão inserida com sucesso!";
        } else {
            echo "Erro ao inserir as opções: " . mysqli_error($conexao);
        }
    } else {
        echo "Erro ao inserir a questão: " . mysqli_error($conexao);
    }

    // Close the database connection
    mysqli_close($conexao);
}
?>

