<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>rrCONCURSOS/</title>
    <link rel="stylesheet" href="../view/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Add spacing between news items */
        .news-section .card {
            margin-bottom: 20px;
            margin-top: 20px;
        }

        footer {
            display: flex;
            background: #58c24e;
            height: 150px;
            border-bottom: 1px solid #E0E6F8;
            justify-content: space-between;
            padding: 8px;
        }
    </style>

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
            <li><a href="../control/vestibular.php">VESTIBULAR</a></li>
            <li><a href="../control/aulas.php">AULAS</a></li>
            <li><a href="../control/questoes.php">QUESTÕES</a></li>
            <li><a href="../control/outroscads.php">OUTROS CADERNOS</a></li>
            <li><a href="../control/noticias.php">NOTICIAS</a></li>
            <li><a href="../control/infos.php">+INFOS</a></li>
        </div>
    </header>
    <main class="MainIn">

        <div class="news-section container"> <!-- Add 'container' class for Bootstrap styling -->
            <?php
            include "conection.php";
            $sql = "SELECT * FROM tb_news";
            $result = $mysqli->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='news card mb-3'>"; // Add 'card' and 'mb-3' classes for Bootstrap card styling
                    echo "<div class='card-body'>";
                    if (!empty($row["img"])) {
                        echo "<img src='" . $row["img"] . "' alt='News Image' class='img-fluid'>";
                    }
                    echo "<h2 class='card-title'>" . $row["title"] . "</h2>";
                    echo "<p class='card-text'>" . $row["news"] . "</p>";

                    // Format the date in Western style
                    $date = date('d/m/Y', strtotime($row["date"]));
                    echo "<p class='card-text'>Date: " . $date . "</p>";

                    echo "</div>";
                    echo "</div>";
                }
            } else {
                echo "No news available.";
            }

            $mysqli->close();
            ?>

        </div>
    </main>
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

        </ul>
        <div class="bluep2">RR CONCURSOS</div>


    </footer>


    <!-- Add Bootstrap JS scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>