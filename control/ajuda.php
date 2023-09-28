<?php
include('protect.php');
?>
<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="high=device-high, initial-scale=1.0">
    <meta charset="UTF-8">
    <title>rrCONCURSOS/</title>
    <link rel="stylesheet" href="../view/style.css">
    <style>
        .info{
            high: 210px ;
            font-size: 28px ;
            align-items: center ;
        }

        .x{ 
            height: 200 px;
            width: 80%
            align-items: center;
        }

.MainIni{
    height: 700px;
    width: 100%;
    background: #E0E6F8;
   padding: 8px;
    display: flex;
    align-items: center;
    align-content: center;
    
   
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

    <main class="MainIni">
        <br>
      <div class="info">
        <p> Aqui temos alguns serviços que podem lhe ajudar se for necessário.</p>
            <br>
            <h3>Quer fazer seu cadastro? <a href="../control/cadastro.php">Clique Aqui</a> </h3>
            <p>Em caso de mais dúvidas, entre em contato conosco: contato@email.com </p>
            <br>
            perguntas:<br>
            "como faço login para acessar as questoes?"<br>
            -Basta ir em 'entrar' e utilizar sua conta, após fazer login, vá em 'questoes' e está pronto!
            <br><br>
            "Onde vejo novos concursos e provas?"<br>
            -Simples! Entre em 'noticias' e procure o que precisa, veja possíveis novas avaliações e etc.
            <br><br>
            

      </div>

       <div class="x">
       
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
            <li class="ulf">Avalie-nos</li>
        </ul>
        <div class="bluep2">RR CONCURSOS</div>


    </footer>




</body>

</html>