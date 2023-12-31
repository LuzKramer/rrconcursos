<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <title>rrCONCURSOS/ajuda</title>
    <link rel="stylesheet" href="../view/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .info {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 80vh;
            /* Ajuste a altura conforme necessário */
            padding: 10px;

            border-radius: 5px;
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

    <main class="MainIn">
        <br>
        <div class="info">
            <p>Aqui temos alguns serviços que podem lhe ajudar se for necessário.</p>
            <br>
            <h3>Quer fazer seu cadastro? <a href="../control/cadastro.php">Clique Aqui</a> </h3>
            <p>Em caso de mais dúvidas, entre em contato conosco: contato@email.com </p>
            <br>
            <p>Perguntas Frequentes:</p>
            <ul>
                <li><strong>Como faço login para acessar as questões?</strong> - Basta ir em <a href="login.php">Login</a> e utilizar sua conta, após fazer login, vá em 'Questões' e está pronto!</li>
                <li><strong>Onde vejo novos concursos e provas?</strong> - Simples! Entre em <a href="noticias.php">Noticias</a> e procure o que precisa, veja possíveis novas avaliações e etc.</li>
                <li><strong>Como desconecto minha conta?</strong> - Vá em <a href="login.php">Login</a> e aperte em logout </li>
            </ul>
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
</body>

</html>