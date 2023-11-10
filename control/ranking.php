<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <title>rrCONCURSOS/ajuda</title>
    <link rel="stylesheet" href="../view/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        
    </style>

</head>

<body>
    <header class="d-flex flex-wrap align-items-center justify-content-between py-3 border-bottom">
        <div class="col-md-3 mb-2 mb-md-0">
            <a href="/" class="d-inline-flex link-body-emphasis text-decoration-none">
                <svg class="bi" width="40" height="32" role="img" aria-label="Bootstrap">
                    <use xlink:href="#bootstrap"></use>
                </svg>
            </a>
        </div>

        <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
            <li class="nav-item"><a href="../index.php" class="nav-link px-2 link-secondary">Início</a></li>
            <li class="nav-item"><a href="filtro.php" class="nav-link px-2">Questões</a></li>
            <li class="nav-item"><a href="infos.php" class="nav-link px-2">Informações</a></li>
            <li class="nav-item"><a href="ajuda.php" class="nav-link px-2">Ajuda</a></li>
            <li class="nav-item"><a href="noticias.php" class="nav-link px-2">Notícias</a></li>
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
        <?php
        include('conection.php');
        $sql = "SELECT * FROM tb_login ORDER BY pontos DESC LIMIT 20;";
        $query = mysqli_query($mysqli, $sql);

        if (mysqli_num_rows($query) > 0) {
            echo '<table class="table">';
            echo '<thead><tr><th>Nome</th><th>Pontos</th></tr></thead>';
            echo '<tbody>';
            while ($row = mysqli_fetch_assoc($query)) {
                echo '<tr>';
                echo '<td>' . $row['nome'] . '</td>';
                echo '<td>' . $row['pontos'] . '</td>';
                echo '</tr>';
            }
            echo '</tbody>';
            echo '</table>';
        } else {
            echo 'No data available.';
        }
        ?>

    </main>

    <footer class="py-3">
        <ul class="nav justify-content-center border-bottom pb-3 mb-3">
            <li class="nav-item"><a href="../index.php" class="nav-link px-2 text-body-secondary">Início</a></li>
            <li class="nav-item"><a href="infos.php" class="nav-link px-2 text-body-secondary">+Infos</a></li>
            <li class="nav-item"><a href="noticias.php" class="nav-link px-2 text-body-secondary">Notícias</a></li>
            <li class="nav-item"><a href="ajuda.php" class="nav-link px-2 text-body-secondary">Ajuda</a></li>
            <li class="nav-item"><a href="us.php" class="nav-link px-2 text-body-secondary">Sobre Nós</a></li>
        </ul>
        <p class="text-center text-body-secondary">© 2023 RRconcursos</p>
    </footer>
</body>

</html>