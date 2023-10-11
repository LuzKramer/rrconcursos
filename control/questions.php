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
                    $imagem = $resultado['imagem'];
                    if ($imagem != "") {
                        echo "<img src='$imagem' alt='Imagem not found'> </img>" . '<br>';
                    }
                    $enunciado = $resultado['enunciado'];
                    $ano_questao = $resultado['ano'];
                    $disciplina_questao = $resultado['nome_disciplina'];
                    echo "<h1> $enunciado </h1>" . " - " .  $disciplina_questao . " - Ano: " . $ano_questao . '<br>';
                    echo "Opções: ";
                    echo '<br>';
                    echo "<input type='radio' name='escolha' id='' value='" . $resultado['txt_alt1'] . "'>" . $resultado['txt_alt1'] . '<br>';
                    echo "<input type='radio' name='escolha' id='' value='" . $resultado['txt_alt2'] . "'>" . $resultado['txt_alt2'] . '<br>';
                    echo "<input type='radio' name='escolha' id='' value='" . $resultado['txt_alt3'] . "'>" . $resultado['txt_alt3'] . '<br>';
                    echo "<input type='radio' name='escolha' id='' value='" . $resultado['txt_alt4'] . "'>" . $resultado['txt_alt4'] . '<br>';
                    echo "<input type='radio' name='escolha' id='' value='" . $resultado['txt_alt5'] . "'>" . $resultado['txt_alt5'] . '<br>';
                    echo "<input type='submit' name='envio" . $responder . "' value='Enviar'>";
                    echo "<input type='reset' name='clear" . $responder . "' value='Apagar'>";
                    echo " <button name='next'>Proxima</button>";
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