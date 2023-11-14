<?php
include "protect.php";
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>rrconcurssos/questoes</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../view/questions.css">


</head>

<body>
    <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3  border-bottom">
        <div class="col-md-3 mb-2 mb-md-0">
            <a href="../index.php" class="d-inline-flex link-body-emphasis text-decoration-none">
                <img src="../view/img/rr.jpeg" alt="Logo" style="width: 80px; height: auto; border-radius: 50%;">
            </a>
        </div>



        <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
            <li><a href="../index.php" class="nav-link px-2 link-secondary text-white">Inicio</a></li>
            <li><a href="filtro.php" class="nav-link px-2 text-white">Questões</a></li>
            <li><a href="ranking.php" class="nav-link px-2 text-white">Ranking</a></li>
            <li><a href="infos.php" class="nav-link px-2 text-white">Infos</a></li>
            <li><a href="ajuda.php" class="nav-link px-2 text-white">Ajuda</a></li>
            <li><a href="noticias.php" class="nav-link px-2 text-white">Noticias</a></li>
        </ul>


        <div class="col-md-3 text-end">
            <?php
            session_start(); // Start or resume the session

            if (isset($_SESSION['nivel'])) {
                // User is logged in
                echo "<button type='button' class='btn btn-primary' onclick='window.location.href = \"logout.php\"'>Logout</button>";
            } else {
                // User is not logged in
                echo "<button type='button' class='btn btn-outline-primary me-2' onclick='window.location.href = \"login.php\"'>Login</button>";
                echo "<button type='button' class='btn btn-primary' onclick='window.location.href = \"cadastro.php\"'>Cadastro</button>";
            }
            ?>

        </div>

    </header>

    <main>

        <div class="question">

            <!-- <h1>ID's feitos: 
                
                <?php
                $idd = array();

                if (isset($_COOKIE['a'])) {
                    $idd = unserialize($_COOKIE['a']);
                }
                ?>


</h1> -->

            <?php


            include("conection.php");
            session_start(); // Start the session to access session variables
            $email = $_SESSION['email'];



            // Check if the session variables for filters are set
            if (isset($_SESSION['filtromateria']) && isset($_SESSION['filtroinstituicao'])) {
                // Filters are set, use the filters in the query
                $materia = $_SESSION['filtromateria']; // Subject filter
                $instituicao = $_SESSION['filtroinstituicao']; // Institution filter
                $questao = "SELECT * FROM questoes as a1, alternativas as a2, disciplinas as a3, instituicao as a4  
                 where a1.id_questao = a2.id_questao 
                 and a1.id_disciplina = a3.id_disciplina
                 AND a1.id_instituicao=a4.id_instituicao
                 and a3.id_disciplina LIKE '%$materia%' 
                 and a1.id_instituicao LIKE '%$instituicao';";
            } else {
                // Filters are not set, fetch all questions
                $questao = "SELECT * FROM questoes as a1, alternativas as a2,
                 disciplinas as a3, instituicao as a4 where a1.id_questao=a2.id_questao
                 and a1.id_disciplina=a3.id_disciplina AND a1.id_instituicao=a4.id_instituicao;";
            }

            $query_questao = mysqli_query($mysqli, $questao);
            // The rest of your code to display questions goes here







            //Perguntas ------------------- --------------------- ------------------




            //Parte 2 - Valiando a resposta correta



            $cont = 0;
            while ($resultado = mysqli_fetch_assoc($query_questao)) {
                $contar = $cont + 1;
                $responder = $responder + $contar;
                $id_questao = $resultado['id_questao'];
                $loucura = $resultado['id_alternativa'] + 2;
                if ($id_questao = $loucura) {
                    if (in_array($id_questao, $idd, true)) {
                        // $query_questao = mysqli_query($mysql, $questao);
                        // echo "<h1>Sem questões</h1>";

                    } else {


            ?>

                        <form action="#" method="POST">
                    <?php

                        //Parte do form, html + php = loucura
                        $enunciado = $resultado['enunciado'];
                        $ano_questao = $resultado['ano'];
                        $disciplina_questao = $resultado['nome_disciplina'];
                        $institui = $resultado['nome_instituicao'];



                        echo '<ul style="display: flex; flex-direction: row; justify-content: space-between; padding:5px;"><li>Matéria: ' . $disciplina_questao . '</li><li>Ano: ' . $ano_questao . '</li><li>Instituição: ' . $institui . '</li></ul>';


                        $imagem = $resultado['imagem'];
                        if ($imagem != "") {
                            echo "<img src='$imagem' alt=''> </img>" . '<br>';
                        }
                        echo "<p>"        . $enunciado .          '</p><br>';

                        echo '<br>';
                        echo "<input type='radio' name='escolha' id='' value='" . $resultado['txt_alt1'] . "'>" . $resultado['txt_alt1'] . '<br>';
                        echo "<input type='radio' name='escolha' id='' value='" . $resultado['txt_alt2'] . "'>" . $resultado['txt_alt2'] . '<br>';
                        echo "<input type='radio' name='escolha' id='' value='" . $resultado['txt_alt3'] . "'>" . $resultado['txt_alt3'] . '<br>';
                        echo "<input type='radio' name='escolha' id='' value='" . $resultado['txt_alt4'] . "'>" . $resultado['txt_alt4'] . '<br>';
                        echo "<input type='radio' name='escolha' id='' value='" . $resultado['txt_alt5'] . "'>" . $resultado['txt_alt5'] . '<br>';
                        echo "<input type='submit' name='envio" . $responder . "' value='Responder' id='enviarr'>";
                        echo "<input type='reset' name='envio" . $responder . "' value='Apagar'>";
                        echo "<button id='vai'>Proxima</button>";
                        echo '<br>';
                        echo '<br>';
                        echo '<br>';

                        if (isset($_POST['envio' . $responder])) {


                            //Parte 2 -Verificação da resposta
                            $escolha = $_POST['escolha'];
                            if ($escolha == "") {
                                echo "marque uma alternativa!";
                            } else {
                                if (isset($_COOKIE['contador'])) {
                                    $conte = $_COOKIE['contador'];
                                    $conte++;
                                } else {
                                    $conte = 1;
                                }

                                setcookie('contador', $conte, time() + 3600);
                                $certo = $resultado['correta'];
                                $resposta_certa =  $resultado['txt_alt' . $certo];

                                if ($resposta_certa === $escolha) {
                                    $idd[] = $id_questao;
                                    $idd_convertido = serialize($idd);
                                    // Adiciona o número digitado ao array
                                    setcookie('a', $idd_convertido, time() + 3600);
                                    echo "<p style='color: green;'>Você acertou !</p>";


                                    // // Codifica o array em formato JSON e define no cookie


                                    // ---------------------------------------CONTADOR ---------------------------------------------------
                                    if (isset($_COOKIE['contador_feito'])) {
                                        $conte2 = $_COOKIE['contador_feito'];
                                        $conte2++;
                                    } else {
                                        $conte2 = 1;
                                    }
                                    setcookie('contador_feito', $conte2, time() + 3600);

                                    $query = "SELECT pontos FROM tb_login WHERE email = '{$email}'";
                                    $result = mysqli_query($mysqli, $query);
                                    $row = $result->fetch_assoc();
                                    $_SESSION['pontos'] = $row['pontos'];

                                    // Increment the points by 1
                                    $pontos = $_SESSION['pontos'];
                                    $pontos++;

                                    // Update the pontos in the database
                                    $query = "UPDATE tb_login SET pontos = {$pontos} WHERE email = '{$email}'";

                                    if ($mysqli->query($query) === TRUE) {
                                        echo '<script>console.log("Contador de acertos atualizado com sucesso!");</script>';
                                    } else {
                                        echo '<script>console.error("Erro na atualização do contador de acertos: ' . $mysqli->error . '");</script>';
                                    }
                                } else {
                                    echo "<p style='color: red;'>Você errou !</p><br>";
                                    echo "A opção certa é: " . $resposta_certa;
                                }
                            }
                        }
                    }
                }



                    ?>
                        </form>

                    <?php
                }

                    ?>
        </div>
    </main>
    <footer class="py-3 ">
        <ul class="nav justify-content-center border-bottom pb-3 mb-3">
            <li class="nav-item"><a href="../index.php" class="nav-link px-2 text-white">Inicio</a></li>
            <li class="nav-item"><a href="infos.php" class="nav-link px-2 text-white">+Infos</a></li>
            <li class="nav-item"><a href="noticias.php" class="nav-link px-2 text-white">Noticias</a></li>
            <li class="nav-item"><a href="ajuda.php" class="nav-link px-2 text-white">Ajuda</a></li>
            <li class="nav-item"><a href="us.php" class="nav-link px-2 text-white">Sobre Nós</a></li>
        </ul>

        <p class="text-center text-body-secondary">© 2023 RRconcursos</p>
    </footer>
    <script>
        $(document).ready(function() {
            $("#tome").click(function() {
                $("body").css("background", "#fff")
                $("form").css("background", "black")
            })
            $("#enviarr").click(function() {
                $("form").css("background", "green")
            })
        })
        $(document).ready(function() {
            $("#tome2").click(function() {
                $("body").css("background", "black")
                $("form").css("background", "blueviolet")
            })
        })
        $("#vai").click(function() {
            $("form").load('question.php');
        });


        document.getElementById("meuFormulario").addEventListener("submit", function(event) {
            event.preventDefault(); // Impede o comportamento padrão do formulário (recarregar a página)
        });
    </script>
</body>

</html>