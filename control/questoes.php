

<?php
include('protect.php');
include('conection.php');
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>rrCONCURSOS/questoes</title>
    <link rel="stylesheet" href="../view/style.css">
</head>

<body>
    <header class="header">
        <div class="dv1">
            <div class="l1e">
                <div class="bluep"><img src="../view/img/rr.jpeg" height="35px"></div>

                <ul class="ul1">
                    <li><a href="../index.php">menu</a></li>
                </ul>
            </div>
            <h1>rr CONCURSOS</h1>
            <ul class="ul2">
                <li><a href="../control/ajuda.php">ajuda</a></li>
                <li><a href="../control/assinar.php">assinar</a></li>
                <li><a href="../control/inout.php">entrar</a></li>
            </ul>
        </div>


        <div class="l2">

            <li><a href="../index.php">INICIO</a></li>
            <li><a href="../control/estibular.php">VESTIBULAR</a></li>
            <li><a href="../control/aulas.php">AULAS</a></li>
            <li><a href="../control/questoes.php">QUESTÕES</a></li>



            <li><a href="../control/outroscads.php">OUTROS CADERNOS</a></li>
            <li><a href="../control/noticias.php">NOTICIAS</a></li>
            <li><a href="../control/infos.php">+INFOS</a></li>

        </div>

    </header>
    <div class="schwein">
        <form action="" class="formse" method="POST">
            <label for="instituicao">Instituição:</label>
            <select name="instituicao" id="instituicao" required>
                <?php
                // Retrieve the institutions from the database
                $query_instituicao = "SELECT id_instituicao, nome_instituicao FROM instituicao";
                $result_instituicao = $mysqli->query($query_instituicao);

                // Display the options for institutions
                while ($row_instituicao = $result_instituicao->fetch_assoc()) {
                    echo '<option value="' . $row_instituicao['id_instituicao'] . '">' . $row_instituicao['nome_instituicao'] . '</option>';
                }

                // Close the result set
                $result_instituicao->free_result();
                ?>
            </select>

            <label for="materia">Matéria:</label>
            <select name="materia" id="materia" required>
                <?php
                // Retrieve the disciplines from the database
                $query_disciplinas = "SELECT id_disciplina, nome_disciplina FROM disciplinas";
                $result_disciplinas = $mysqli->query($query_disciplinas);

                // Display the options for disciplines
                while ($row_disciplina = $result_disciplinas->fetch_assoc()) {
                    echo '<option value="' . $row_disciplina['id_disciplina'] . '">' . $row_disciplina['nome_disciplina'] . '</option>';
                }

                // Close the result set      width: 500px;
                 
                $result_disciplinas->free_result();
                ?>
            </select>
            <input type="submit" name="submit" value="filtrar">
        </form>
    </div>

    <section class="principal">


        <main class="main1">
       
        


        <div class="form">

        <div>







        <?php

// Array com as perguntas e opções de resposta
$perguntas = array(
    "<h1>Qual é a capital do Brasil?</h1>" => array(
        "A" => "Rio de Janeiro",
        "B" => "São Paulo",
        "C" => "Brasília",
        "D" => "Salvador"
    ),

    "<h1>Qual é a cor do céu?</h1>" => array(
        "A" => "Azul",
        "B" => "Verde",
        "C" => "Amarelo",
        "D" => "Vermelho"
    ),

    "<h1>Qual é o maior planeta do sistema solar?</h1>" => array(
        "A" => "Júpiter",
        "B" => "Terra",
        "C" => "Marte",
        "D" => "Vênus"
    ),

    "<h1>Qual é o animal terrestre mais rápido?</h1>" => array(
        "A" => "Leopardo",
        "B" => "Guepardo",
        "C" => "Lobo",
        "D" => "Lebre"
    ),

    "<h1>Qual é a montanha mais alta do mundo?</h1>" => array(
        "A" => "Monte Everest",
        "B" => "Monte Kilimanjaro",
        "C" => "Monte Aconcágua",
        "D" => "Monte Fuji"
    ),

    "<h1>Qual é o maior país em área territorial?</h1>" => array(
        "A" => "Rússia",
        "B" => "Canadá",
        "C" => "China",
        "D" => "Estados Unidos"
    ),

    "<h1>Qual é o maior oceano do mundo?</h1>" => array(
        "A" => "Oceano Pacífico",
        "B" => "Oceano Atlântico",
        "C" => "Oceano Índico",
        "D" => "Oceano Ártico"
    ),

    "<h1>Quantos continentes existem no mundo?</h1>" => array(
        "A" => "5",
        "B" => "6",
        "C" => "7",
        "D" => "8"
    ),

    "<h1>Qual é o símbolo químico do ouro?</h1>" => array(
        "A" => "Au",
        "B" => "Ag",
        "C" => "Cu",
        "D" => "Fe"
    ),

    "<h1>Qual é o maior felino do mundo?</h1>" => array(
        "A" => "Tigre",
        "B" => "Leão",
        "C" => "Leopardo",
        "D" => "Jaguar"
    ),
);

// Função para embaralhar as perguntas
function shufflePerguntas($perguntas) {
    $keys = array_keys($perguntas);
    shuffle($keys);
    $perguntasEmbaralhadas = array();
    foreach ($keys as $key) {
        $perguntasEmbaralhadas[$key] = $perguntas[$key];
    }
    return $perguntasEmbaralhadas;
}

// Verifica se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Array para armazenar as respostas selecionadas e se estão corretas ou não
    $respostas = array();

    // Loop pelas perguntas
    foreach ($perguntas as $pergunta => $opcoes) {
        // Verifica se a resposta foi selecionada
        if (isset($_POST[$pergunta])) {
            $resposta = $_POST[$pergunta];
            $correta = ($resposta == $opcoes['C']); // Verifica se a resposta é igual à opção correta (nesse exemplo, a opção 'C' é sempre a correta)
            $respostas[$pergunta] = array(
                "resposta" => $resposta,
                "correta" => $correta,
                "resultado" => ($correta ? "Acertou" : "Errou") // Adiciona o resultado (acertou ou errou) ao array de respostas
            );
        }
    }

    // Exibe as respostas selecionadas e se estão corretas ou não
    echo "<h2>Respostas selecionadas:</h2>";
    foreach ($respostas as $pergunta => $resposta) {
        echo "<p>$pergunta: {$resposta['resposta']} - {$resposta['resultado']}</p>";
    }
}

// Embaralha as perguntas
$perguntasEmbaralhadas = shufflePerguntas($perguntas);

?>

<form method="POST">
    <?php
    // Loop pelas perguntas embaralhadas
    foreach ($perguntasEmbaralhadas as $pergunta => $opcoes) {
        echo "<h3>$pergunta</h3>";
        // Loop pelas opções de resposta
        foreach ($opcoes as $opcao => $texto) {
            echo "<label>";
            echo "<input type='radio' name='$pergunta' value='$texto'>";
            echo $texto;
            echo "</label>";
        }
    }
    ?>
    <br>
    <input type="submit" value="Enviar">
</form>



































        








  
           <form>
            
        <?php

echo '
<style>
    .my-div {
        width: 1px;
        height: 30%;
        background: #309c66; 
        margin: 15px;
        border-radius: 10px;
        padding: 8px;
        box-shadow: 1px 1px 1px rgb(0, 0, 0);
        margin-bottom: 140px;
    }
</style>
<div class="my-div">
    


</div>';



?>

  
  
        



        </form>



        

         </div>

                   



</div>
 



    
            <?php


            if (isset($_POST['submit'])) {
                $selectedInstituicao = $_POST['instituicao'];
                $selectedMateria = $_POST['materia'];

                // Modify your SQL query to include the selected options as filters
                $questao = "SELECT * FROM questoes as a1, alternativas as a2, disciplinas as a3 WHERE a1.id_questao = a2.id_questao";
                $questao .= " AND a1.id_instituicao = $selectedInstituicao";
                $questao .= " AND a1.id_disciplina = $selectedMateria";

                $query_questao = mysqli_query($mysqli, $questao);
            

            //Perguntas ------------------- --------------------- ------------------




            //Parte 2 - Valiando a resposta correta



            $cont = 0;
            while ($resultado = mysqli_fetch_assoc($query_questao)) {
                $contar = $cont + 1;
                $responder = $responder + $contar;
                $resultado['id_questao'] = $resultado['id_alternativa'];
                if ($resultado['id_questao'] === $resultado['id_alternativa']) {
                }
            ?>



                <form action="" method="POST">
                <?php
                echo "<img src='../view/img/rr.jpeg' alt='Imagem not found'> </img>" . '<br>';

                $enunciado = $resultado['enunciado'];
                $ano_questao = $resultado['ano'];
                $disciplina_questao = $resultado['nome_disciplina'];
                echo "<h1> $enunciado </h1>" . " - " .  $disciplina_questao . " - Ano: " . $ano_questao . '<br>';
                $imagem = $resultado['imagem'];
                if ($imagem != "") {
                }
                echo "Opções: ";
                echo '<br>';
                echo "<input type='radio' name='escolha' id='' value='" . $resultado['txt_alt1'] . "'>" . $resultado['txt_alt1'] . '<br>';
                echo "<input type='radio' name='escolha' id='' value='" . $resultado['txt_alt2'] . "'>" . $resultado['txt_alt2'] . '<br>';
                echo "<input type='radio' name='escolha' id='' value='" . $resultado['txt_alt3'] . "'>" . $resultado['txt_alt3'] . '<br>';
                echo "<input type='radio' name='escolha' id='' value='" . $resultado['txt_alt4'] . "'>" . $resultado['txt_alt4'] . '<br>';
                echo "<input type='radio' name='escolha' id='' value='" . $resultado['txt_alt5'] . "'>" . $resultado['txt_alt5'] . '<br>';
                echo "<input type='submit' name='envio" . $responder . "' value='Enviar'>";
                echo "<input type='reset' name='envio" . $responder . "' value='Apagar'>";
                echo '<br>';

                if (isset($_POST['envio' . $responder])) {


                    $certo = $resultado['correta'];
                    $resposta_certa =  $resultado['txt_alt' . $certo];
                    $escolha = $_POST['escolha'];
                    if ($resposta_certa === $escolha) {
                        echo "Portanto, está certo(a)";
                    } else {
                        echo "Portanto, está errado(a)";
                    }
                }
            }
        }
                ?>


                </form>
        </main>
        <br><br><br>

    </section>

    <footer>
        <ul>
            <li class="ulf">RR CONCURSOS</li>
            <li class="ulf">Provas</li>
            <li class="ulf">Video aulas</li>
            <li class="ulf">Disciplinas</li>
            <li class="ulf">Sobre Nós</li>

        </ul>
        <ul>
            <li class="ulf">PAGINAS ÚTEIS</li>
            <li class="ulf">Noticias</li>
            <li class="ulf">Como usar o RR CONCURSOS</li>
            <li class="ulf">Avalie-nos</li>
        </ul>
        <div class="bluep2">RR CONCURSOS</div>


    </footer>



</body>






</html>