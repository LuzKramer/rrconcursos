




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TOME</title>
    <link rel="stylesheet" href="../view/question.css">
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>

</head>

<body>
    <header>
        <button id="tome">Modo Claro</button>
        <button id="tome2">Modo Escuro
        </button>
        <a href="escolha.php"><input type="button" value="Voltar"></a>
    </header>
    <main>


        <?php
        include("conection.php");



        if (isset($_COOKIE['questoes_respondidas'])) {
            $questoesRespondidas = json_decode($_COOKIE['questoes_respondidas']);
        } else {
            $questoesRespondidas = array();
        }
        setcookie('questoes_respondidas', json_encode($questoesRespondidas), time() + (86400 * 3), "/");




        $questao = "SELECT  DISTINCT * 
        FROM questoes AS a1, alternativas AS a2, disciplinas AS a3 
        WHERE a1.id_questao = a2.id_questao 
        AND a1.id_disciplina = a3.id_disciplina 
        AND a1.id_questao 
        LIMIT 1;";


        $query_questao = mysqli_query($mysqli, $questao);









        //Perguntas ------------------- --------------------- ------------------




        //Parte 2 - Valiando a resposta correta



        $cont = 0;
        while ($resultado = mysqli_fetch_assoc($query_questao)) {
            $contar = $cont + 1;
            $responder = $responder + $contar;
            $resultado['id_questao'] = $resultado['id_alternativa'];
            if ($resultado['id_questao'] === $resultado['id_alternativa']) {


        ?>
                <?php
                // coloque um 
                ?>
                <div id="diform">
                    <form action="" method="POST" id="form">
                    <?php


                    $enunciado = $resultado['enunciado'];
                    $ano_questao = $resultado['ano'];
                    $disciplina_questao = $resultado['nome_disciplina'];
                    echo "<h1> $enunciado </h1>" . " - " .  $disciplina_questao . " - Ano: " . $ano_questao . '<br>';
                    $imagem = $resultado['imagem'];
                    if ($imagem != "") {
                        echo "<img src='$imagem' alt='Imagem not found'> </img>" . '<br>';
                    }
                    echo "Opções: ";
                    echo '<br>';
                    echo "<input type='radio' name='escolha' id='' value='" . $resultado['txt_alt1'] . "'>" . $resultado['txt_alt1'] . '<br>';
                    echo "<input type='radio' name='escolha' id='' value='" . $resultado['txt_alt2'] . "'>" . $resultado['txt_alt2'] . '<br>';
                    echo "<input type='radio' name='escolha' id='' value='" . $resultado['txt_alt3'] . "'>" . $resultado['txt_alt3'] . '<br>';
                    echo "<input type='radio' name='escolha' id='' value='" . $resultado['txt_alt4'] . "'>" . $resultado['txt_alt4'] . '<br>';
                    echo "<input type='radio' name='escolha' id='' value='" . $resultado['txt_alt5'] . "'>" . $resultado['txt_alt5'] . '<br>';
                    echo "<input type='submit' name='envio" . $responder . "' value='Enviar' id='enviarr'>";
                    echo "<input type='reset' name='reset" . $responder . "' value='Apagar'>";
                    echo '<br>';
                    echo '<br>';
                    echo '<br>';
                    

                    //Parte 2 -Verificação da resposta
                    if (isset($_POST['envio' . $responder])) {
                        $escolha = $_POST['escolha'];
                        if ($escolha == "") {
                            echo "marque uma alternativa!";
                        }
                        $certo = $resultado['correta'];
                        $resposta_certa =  $resultado['txt_alt' . $certo];
                        echo "A opção certa é: " . $resposta_certa;
                        echo "Você marcou:  $escolha" . ' ';
                        if ($resposta_certa === $escolha) {

                            echo "Portanto, está certo(a)";
                            // if (isset($_COOKIE['quest_feita'])) {
                            //     $cookieValue = $_COOKIE['quest_feita'];
                            //     $questoesFeitas = json_decode($cookieValue, true);
                            // } else {
                            //     $questoesFeitas = array();
                            // }

                            // // // Adicione a nova questão ao array
                            // $questao = $resultado['id_questao'];
                            // $questoesFeitas[] = $questao;


                            // $questoesFeitasSerializado = json_encode($questoesFeitas);
                            // setcookie('quest_feita', $questoesFeitasSerializado, time() + 3600);


                            $questao = $resultado['id_questao'];
                            $questoesRespondidas[] = $questao;
                        } else {
                            echo "Portanto, está errado(a)";
                        }
                    }
                }




                    ?>
                    </form>
                    <form action="">
                        <input type="submit" name="next" value="Proxima">
                    </form>
                </div>

            <?php

           
        }
            ?>

    </main>
    <script>
        $("#next").click(function(){
            $("#form").load("question.php")
        });

    </script>

</body>

</html>