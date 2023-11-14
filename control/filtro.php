<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>rrCONCURSOS/noticias</title>
    <link rel="stylesheet" href="../view/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .MainIn {
            background-color: #f0f0f0;
            /* Set your desired background color */
            padding: 20px;
            /* Add some padding for spacing */
        }

        .MainIn h1 {
            font-size: 24px;
            /* Set the heading size to your preference */
            color: #333;
            /* Set the heading text color */
            margin-bottom: 20px;
            /* Add space below the heading */
        }

        .MainIn label {
            font-weight: bold;
            /* Make labels bold */
        }

        .MainIn select {
            width: 100%;
            /* Make the select elements full-width */
            padding: 10px;
            /* Add padding for better spacing */
            margin-bottom: 10px;
            /* Add space between select elements */
        }

        .MainIn input[type="submit"] {
            background-color: #007bff;
            /* Set a button background color */
            color: #fff;
            /* Set button text color */
            padding: 10px 20px;
            /* Add padding to the button */
            border: none;
            /* Remove button border */
            cursor: pointer;
            /* Add a pointer cursor to the button */
        }

        .MainIn button {
            background-color: #007bff;
            /* Set a button background color */
            color: #fff;
            /* Set button text color */
            padding: 10px 20px;
            /* Add padding to the button */
            border: none;
            /* Remove button border */
            cursor: pointer;
            /* Add a pointer cursor to the button */
            margin-top: 10px;
            /* Add space above the button */
        }
    </style>

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


    <main class="MainIn">
        <h1>Escolha seus filtros</h1>
        <section>
            <?php
            include('conection.php');

            if ($_SERVER["REQUEST_METHOD"] === "POST") {
                session_start();

                // Retrieve selected institution and subject from the form
                $instituicao = $_POST['instituicao'];
                $materia = $_POST['materia'];

                // Store the selected values in session variables
                $_SESSION['filtromateria'] = $materia;
                $_SESSION['filtroinstituicao'] = $instituicao;

                // Redirect to a page that will display filtered questions
                header("Location: questions.php");
                exit;
            }

            // Retrieve the institutions from the database
            $query_instituicao = "SELECT id_instituicao, nome_instituicao FROM instituicao";
            $result_instituicao = mysqli_query($mysqli, $query_instituicao);
            ?>

            <form method="POST" action="">
                <label for="instituicao">Instituição:</label>
                <select name="instituicao" id="instituicao" required>
                    <?php
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
                    <h3>O filtro é exatamente está selecionado </h3>
                </select>

                <input type="submit" value="Filtrar questões">
            </form>
            <a href="questions.php" onclick="limparFiltrosSessao()">
                <button>Fazer questões sem filtros</button>
            </a>
        </section>



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

    <!-- Add Bootstrap JS scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        function limparFiltrosSessao() {
            // Limpar as variáveis de filtro da sessão
            <?php
            session_start();
            unset($_SESSION['filtromateria']);
            unset($_SESSION['filtroinstituicao']);
            ?>
        }
    </script>
</body>

</html>