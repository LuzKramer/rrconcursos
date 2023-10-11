<!DOCTYPE html>
<html lang="en">

<head>
    <script src="https://kit.fontawesome.com/d1274c8dc0.js" crossorigin="anonymous"></script>
   
    <title>RRconcursos</title>
    <style>
        body {
            margin: 0;
            overflow: hidden;
        }

        .menu {
            width: 80vw;
            height: 95vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .esq {
            width: 50vw;
            justify-content: center;
            align-items: center;
            text-align: center;
            padding: 365px 0px;
            background-color: #0efcad;
        }

        .log {
            text-decoration: none;
            color: black;
            margin: 20px;
            padding: 10px 30px;
            border: 0px;
            border-radius: 15px;
            background-color: #0efcad;
            font-size: large;
            font-weight: bold;
        }

        .dir {
            width: 50vw;
            justify-content: center;
            align-items: center;
            text-align: center;
            color: black;
        }

        p {
            color: #0efcad;
        }

        i {
            color: black;
            padding: 15px;
            border-radius: 50%;
            background-color: transparent;
            position: relative;
            text-align: center;
            font-size: 50px;
        }
    </style>
</head>

<body>
    <div class="menu">
        <div class="esq">
            <img src="view/img/rr.jpeg" alt="" height="100px" width="150px"><br><br><br>
            <h1>Seu caminho para o futuro começa aqui</h1>
            <div class="social">
                <h2><a href="control/infos.php">Mais Informações</a></h2>
               
            </div>
        </div>
        <div class="dir">
            <h1>Entre em uma nova jornada ou <br>
                <p>continue de onde parou</p>
            </h1><br><br>
            <a class="log" href="control/login.php">LOGIN</a>
            <a class="log" href="control/cadastro.php">CADASTRE-SE</a>
        </div>
    </div>
    
</body>

</html>