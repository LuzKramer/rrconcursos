
<?php
include"adms/protectdash.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
  <meta charset="UTF-8">
  <title>administração</title>
  <style>
    header{
        background-color: white;
    }

    body {
        background-color: grey;
    }


  </style>
</head>
<body>
<header class="d-flex justify-content-center py-3">
      <ul class="nav nav-pills">
            <li class="nav-item"><a href="../index.php" class="nav-link active" aria-current="page">Home</a></li>
            <li class="nav-item"><a href="adms/viewquest.php" class="nav-link">questoes</a></li>
            <li class="nav-item"><a href="adms/bancas.php" class="nav-link"> Bancas</a></li>
            <li class="nav-item"><a href="adms/institui.php" class="nav-link"> Instituições</a></li>
            <li class="nav-item"><a href="adms/disciplinas.php" class="nav-link">Disciplinas</a></li>
            <li class="nav-item"><a href="adms/news.php" class="nav-link">nova noticia</a></li>
            <li class="nav-item"><a href="adms/admcadastro.php" class="nav-link">cadastrar adm</a></li>
            <li class="nav-item"><a href="adms/news.php" class="nav-link">nova noticia</a></li>
            <li class="nav-item"><a href="../control/logout.php" class="nav-link">sair</a></li>
      </ul>
    </header>

</body>
</html>
