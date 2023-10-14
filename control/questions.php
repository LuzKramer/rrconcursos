<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Código QUESTÃO</title>


    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Style for the main section */

        body {
            height: 100vh;
            padding: 25px;
            min-width: 200px;
            margin: 0px;
            padding: 0px;
        }



        header {

            background: #58c24e;
        }

        main {
            height: 100%;
            background: white;
            display: flex;
            flex-direction: center;
            justify-content: center;
            justify-items: center;

        }

        .fq{
            height: 100%;
            width: 100%;
            justify-content: center;
            border: 1px black;

        }

        .fq h1 {

            text-align: center;
        }

        .fq input[type=radio] {

            width: 40px;

        }



        .fq input[type=submit] {
            width: 100px;
            background-color: green;
            color: white;
        }

        /* Style for individual questions */
        .question {
            height: 100%;
            justify-content: center;
            justify-items: center;
            overflow: hidden;
            padding-top: 50px;
        }

        /* Style for images */
        .question img {
            max-width: 100%;
            height: 20%;
        }


        footer {
            background: #58c24e;

        }
    </style>
</head>

<body>

    <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3  border-bottom">
        <div class="col-md-3 mb-2 mb-md-0">
            <a href="/" class="d-inline-flex link-body-emphasis text-decoration-none">
                <svg class="bi" width="40" height="32" role="img" aria-label="Bootstrap">
                    <use xlink:href="#bootstrap"></use>
                </svg>
            </a>
        </div>

        <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
            <li><a href="../index.php" class="nav-link px-2 link-secondary">Inicio</a></li>
            <li><a href="questions.php" class="nav-link px-2">Questões</a></li>
            <li><a href="infos.php" class="nav-link px-2">Informações</a></li>
            <li><a href="ajuda.php" class="nav-link px-2">Ajuda</a></li>
            <li><a href="noticias.php" class="nav-link px-2">Noticias</a></li>
        </ul>

        <div class="col-md-3 text-end">
            <button type="button" class="btn btn-outline-primary me-2" onclick="window.location.href = 'login.php'">Login</button>
            <button type="button" class="btn btn-primary" onclick="window.location.href = 'cadastro.php'">Cadastro</button>
        </div>

    </header>
    <main>
        <div class="question">


            <?php

            //É prreciso, aceita que dói menos
            $idd = array();

            if (isset($_COOKIE['a'])) {
                $idd = unserialize($_COOKIE['a']);
            }


            include("conection.php");
            //Coloque o seu banco de dados, esse é o meu
            //Sem banco de dados, não funciona

            $questao = "SELECT * FROM questoes as a1
            JOIN alternativas as a2 ON a1.id_questao = a2.id_questao
            JOIN disciplinas as a3 ON a1.id_disciplina = a3.id_disciplina
            JOIN instituicao as a4 ON a1.id_instituicao = a4.id_instituicao";


            $query_questao = mysqli_query($mysqli, $questao);

            //Preparação das questões, algumas coisas necessárias
            //Não é preciso explicar o que cada um faz

            $cont = 0; //Contadorzin
            while ($resultado = mysqli_fetch_assoc($query_questao)) { //Enquanto tiver as questões...


                $contar = $cont + 1;
                $responder = $responder + $contar;

                //Ajustando o banco de dados
                $id_questao = $resultado['id_questao'];
                $loucura = $resultado['id_alternativa'] + 2;

                //Verifica se já respondeu...
                if ($id_questao = $loucura) {
                    if (in_array($id_questao, $idd, true)) {
                        // $query_questao = mysqli_query($mysql, $questao);
                        // echo "<h1>Sem questões</h1>";

                    } else {


            ?>
                        <!-- Criando um form para cada questão -->
                        <form action="#" method="POST" class="fq">
                    <?php

                        //Parte do form, html + php = loucura
                        $enunciado = $resultado['enunciado'];
                        $ano_questao = $resultado['ano'];
                        $disciplina_questao = $resultado['nome_disciplina'];
                        $institui = $resultado['nome_instituicao'];


                        echo '<ul style="display: flex; flex-direction: row; justify-content: space-between;"><li>Matéria: ' . $disciplina_questao . '</li><li>Ano: ' . $ano_questao . '</li><li>Instituição: ' . $institui . '</li></ul>';



                        $imagem = $resultado['imagem'];
                        if ($imagem != "") {
                            echo "<img src='$imagem' alt=''> </img>" . '<br>';
                        }
                        echo "<h1>" . $enunciado . '</h1><br>';

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

                        //Verificando a resposta
                        if (isset($_POST['envio' . $responder])) {

                            //Se não marcar nada...
                            $escolha = $_POST['escolha'];
                            if ($escolha == "") {
                                echo "marque uma alternativa!";
                            } else {

                                $certo = $resultado['correta'];
                                $resposta_certa =  $resultado['txt_alt' . $certo];

                                if ($resposta_certa === $escolha) {
                                    // Se acertar
                                    $idd[] = $id_questao;
                                    $idd_convertido = serialize($idd);

                                    // Definindo o COOKIE, o tempo em que a questão ficará armazenada
                                    setcookie('a', $idd_convertido, time() + 3600);
                                    echo "<p style='color: green;'>Você acertou !</p>";
                                } else {
                                    // Se errar
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
            <li class="nav-item"><a href="../index.php" class="nav-link px-2 text-body-secondary">Inicio</a></li>
            <li class="nav-item"><a href="infos.php" class="nav-link px-2 text-body-secondary">+Infos</a></li>
            <li class="nav-item"><a href="noticias.php" class="nav-link px-2 text-body-secondary">Noticias</a></li>
            <li class="nav-item"><a href="ajuda.php" class="nav-link px-2 text-body-secondary">Ajuda</a></li>
            <li class="nav-item"><a href="us.php" class="nav-link px-2 text-body-secondary">Sobre Nós</a></li>
        </ul>
        <p class="text-center text-body-secondary">© 2023 RRconcursos</p>
    </footer>
</body>

</html>