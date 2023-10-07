<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>rrCONCURSOS/noticias</title>
  <link rel="stylesheet" href="../view/style.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
    /* Add spacing between news items */
    .news-section .card {
      margin-bottom: 20px;
      margin-top: 10px;
    }

    header {
      background: #58c24e;
      margin: 0px;
      margin-bottom: 0px;
      height: 100px;
      /* Increase the height to your desired value, for example, 80px */
    }

    footer {
      background: #58c24e;
      margin-top: 0;
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

  <!-- Add Bootstrap JS scripts -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>