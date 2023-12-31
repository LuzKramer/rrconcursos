<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sobre Nós</title>
    <link rel="stylesheet" href="../view/style.css">
    <!-- Adicione o link para o CSS do Bootstrap -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Estilo personalizado */

        .rounded-img {
            border-radius: 50%;
            /* Makes the image round */
            width: 100px;
            /* Adjust the width as needed */
            height: 100px;
            /* Adjust the height as needed */
            object-fit: cover;
            /* Ensures the image covers the entire container */
        }

        .card {
            border: 2px solid #17a2b8;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .card-title {
            color: #333;
        }

        .card-text {
            color: #555;
        }

        h1 {
            text-align: center;
            color: #17a2b8;
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
                echo "<button type='button' class='btn btn-outline-primary me-2' onclick='window.location.href=\"login.php\"' style='background-color: white'>Login</button>";
                echo "<button type='button' class='btn btn-primary' onclick='window.location.href = \"cadastro.php\"'>Cadastro</button>";
            }
            ?>

        </div>

    </header>

    <div class="container mt-5">
        <h1 class="mb-4">Sobre Nós</h1>
        <p>Site para o projeto Dotores da Informática 2023</p>
        <p>Somos alunos do Instituto Federal de Roraima(IFRR) do campus Boa Vista, do curso de Informática do 2° ano do ensino médio. <br>
            fizemos esse sistema para apresentar no evento IF comunidade de 2023 pelo projeto Doutores da Informática. </p>

        <div class="row">
            <!-- Pessoa 1 -->
            <div class="col-md-4">
                <div class="card">
                    <img src="../view/img/will.jpg" class="card-img-top rounded-img" alt="Foto de William Kramer">
                    <div class="card-body">
                        <h5 class="card-title">William Kramer</h5>
                        <p class="card-text">Líder do grupo</p>
                        <p class="card-text">Github: <a href="https://github.com/LuzKramer">LuzKramer</a></p>
                    </div>
                </div>
            </div>

            <!-- Pessoa 2 - Adicione as informações da Pessoa 2 aqui -->
            <div class="col-md-4">
                <div class="card">
                    <img src="../view/img/joao.jpeg" class="card-img-top rounded-img" alt="">
                    <div class="card-body">
                        <h5 class="card-title">João Felipe Khan</h5><br>
                        <p class="card-text"></p>
                        <p class="card-text">Github: <a href=" https://github.com/jfkrs123">jfkrs123</a></p>
                    </div>
                </div>
            </div>

            <!-- Pessoa 3 - Adicione as informações da Pessoa 3 aqui -->
            <div class="col-md-4">
                <div class="card">
                    <img src="imagem_pessoa3.jpg" class="card-img-top rounded-img" alt="">
                    <div class="card-body">
                        <h5 class="card-title">Gustavo de Jesus</h5><br><br>
                        <p class="card-text"></p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <!-- Pessoa 4 - Adicione as informações da Pessoa 4 aqui -->
            <div class="col-md-4">
                <div class="card">
                    <img src="imagem_pessoa4.jpg" class="card-img-top rounded-img" alt="">
                    <div class="card-body">
                        <h5 class="card-title">Vinicios Barros</h5>
                        <p class="card-text"></p>
                    </div>
                </div>
            </div>

            <!-- Pessoa 5 - Adicione as informações da Pessoa 5 aqui -->
            <div class="col-md-4">
                <div class="card">
                    <img src="imagem_pessoa5.jpg" class="card-img-top rounded-img" alt="">
                    <div class="card-body">
                        <h5 class="card-title">Miguel Lestayo</h5>
                        <p class="card-text"></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
    <!-- Adicione o link para o JavaScript do Bootstrap e jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>