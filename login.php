


<!DOCTYPE html>
<html>
<head>
    <title>Tela de Login</title>
    <style>
        body {
            background-color: #0d6efd;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        
        .login-box {
            background-color: white;
            border-radius: 5px;
            padding: 30px;
            text-align: center;
        }
        
        .login-box img {
            margin-bottom: 15px;
        }
        
        .form-floating {
            margin-bottom: 15px;
        }
        
        .form-check {
            margin-top: 15px;
            margin-bottom: 30px;
        }
    </style>
</head>
<body>

<div class="login-box">
    <img src="img/rr.jpeg" alt="" width="72" height="57">
    <h1 class="h3 mb-3 fw-normal">Login</h1>

    <form method="post" id="meuFormulario" onsubmit="return verificarFormulario()">
        <div class="form-floating">
            <label for="floatingName">Nome</label>
            <input type="text" class="form-control" id="floatingName" placeholder="Nome">
        </div>
        <div class="form-floating">
            <label for="floatingInput">Email</label>
            <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
        </div>
        <div class="form-floating">
            <label for="floatingPassword">Senha</label>
            <input type="password" class="form-control" id="floatingPassword" placeholder="senha123qwerty">
        </div>

        <div class="form-check text-start">
            <input class="form-check-input" type="checkbox" value="remember-me" id="flexCheckDefault">
            <label class="form-check-label" for="flexCheckDefault">
                Lembre-me
            </label>
        </div>
        <button class="btn btn-primary w-100 py-2" name="login" type="submit">entrar</button>
    </form>

    <p class="mt-5 mb-3 text-body-secondary">2023</p>
</div>

<script>
    function verificarFormulario() {
        var nome = document.getElementById("floatingName").value;
        var email = document.getElementById("floatingInput").value;
        var senha = document.getElementById("floatingPassword").value;

        if (nome === "") {
            alert("Por favor, preencha o campo Nome");
            return false;
        }

        if (email === "") {
            alert("Por favor, preencha o campo Email");
            return false;
        }

        if (senha === "") {
            alert("Por favor, preencha o campo Senha");
            return false;
        }

        return true;
    }
</script>

</body>
</html>


<?php
/* 
   session_start();


   if(isset($_POST['login'])) {
   
    $nome = $_POST["floatingName"];
    
    
   
    $_SESSION["floatingName"] = $nome;
   
    
    
    header("Location: index.php");
    
}
*/
?>
