

<?php
include"admprotect.php";
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

    // Função para buscar dados da questão
    function getDadosQuestao($conn, $idQuestao) {
        $query = "SELECT * FROM questoes WHERE id_questao = $idQuestao";
        $result = $conn->query($query);
        return $result->fetch_assoc();
    }

    // Função para buscar dados das respostas
    function getDadosRespostas($conn, $idQuestao) {
        $query = "SELECT * FROM alternativas WHERE id_questao = $idQuestao";
        $result = $conn->query($query);
        return $result->fetch_assoc();
    }

    // Atualizar dados da questão e respostas
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $idQuestao = $_POST["id_questao"];
        $novoEnunciado = $_POST["novo_enunciado"];
        // Atualizar enunciado na tabela questoes
        $queryAtualizar = "UPDATE questoes SET enunciado = '$novoEnunciado' WHERE id_questao = $idQuestao";
        $conn->query($queryAtualizar);
        
        // Atualizar opções de respostas na tabela alternativas
        for ($i = 1; $i <= 5; $i++) {
            $novaAlt = $_POST["nova_alt" . $i];
            $queryAltAtualizar = "UPDATE alternativas SET txt_alt$i = '$novaAlt' WHERE id_questao = $idQuestao";
            $conn->query($queryAltAtualizar);
        }
        
        echo "Dados da questão e respostas atualizados com sucesso!";
    }

    $idQuestao = $_GET["id"];
    $dadosQuestao = getDadosQuestao($conn, $idQuestao);
    $dadosRespostas = getDadosRespostas($conn, $idQuestao);
    ?>

<div class="container mt-5">
        <h2 class="mb-4">Editar Questão</h2>
        <form method="POST" action="">
            <input type="hidden" name="id_questao" value="<?php echo $idQuestao; ?>">
            <div class="form-group">
                <label for="novo_enunciado">Enunciado:</label>
                <textarea class="form-control" name="novo_enunciado" rows="4"><?php echo $dadosQuestao["enunciado"]; ?></textarea>
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




