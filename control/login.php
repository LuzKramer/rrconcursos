
<!DOCTYPE html>
<html>
<head>
    <title>Tela de Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
        }

        .top-bar {
            text-align: right;
            padding: 10px;
        }

        .login-box {
            background-color: #ffffff;
            width: 300px;
            margin: 0 auto;
            padding: 20px;
            border-radius: 10px;
            margin-top: 100px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        .login-box img {
            display: block;
            margin: 0 auto;
            margin-bottom: 20px;
        }

        .form-floating {
            margin-bottom: 15px;
        }

        .form-check {
            margin-bottom: 15px;
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
            transition: background-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .text-body-secondary {
            color: #888;
        }
    </style>
</head>
<body>

<div class="top-bar">
    <a href="../control/cadastro.php">Criar conta</a>
</div>

<div class="login-box">
    <img src="../view/img/rr.jpeg" alt="" width="72" height="57">
    <h1 class="h3 mb-3 fw-normal">Login</h1>

    <form method="post" id="meuFormulario" onsubmit="return verificarFormulario()">
        <div class="form-floating">
            <label for="floatingInput">Email</label>
            <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" name="email">
        </div>
        <div class="form-floating">
            <label for="floatingPassword">Senha</label>
            <input type="password" class="form-control" id="floatingPassword" placeholder="senha123qwerty" name="password">
        </div>

        <div class="form-check text-start">
            <input class="form-check-input" type="checkbox" value="remember-me" id="flexCheckDefault">
            <label class="form-check-label" for="flexCheckDefault">
                Lembre-me
            </label>
            <h4>esqueceu a senha ? <a href="editsenha.php">click aqui para mudar a senha </a></h4>
        </div>
        <button class="btn btn-primary w-100 py-2" name="login" type="submit">entrar</button>
    </form>

    <p class="mt-5 mb-3 text-body-secondary">2023</p>
</div>

<script>
    function verificarFormulario() {
        var email = document.getElementById("floatingInput").value;
        var senha = document.getElementById("floatingPassword").value;

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

include('conection.php');


    $email = $mysqli->real_escape_string($_POST['email']);
    $password = $mysqli->real_escape_string($_POST['password']);
   

    $sql_code = "SELECT * FROM tb_login WHERE email = '$email' LIMIT 1 ";
    $sql_exec = $mysqli->query($sql_code) or die("SQL code error: " . $mysqli->error);

    $quantity = $sql_exec->num_rows;

    if ($quantity == 1) {
        $user = $sql_exec->fetch_assoc();

        
       

        if (password_verify($password, $user['senha'])) {
            
            if(!isset($_SESSION)){
                session_start();
            }
            $_SESSION['nome'] = $user['nome'];
            $_SESSION['nivel'] = 2;

            echo "</script>alert('Usuario logado !!! ')</script>";
          
            header("Location: questoes.php");
            exit();
            
        } else {
            echo "</script>alert('Erro ao logar! Email ou senha incorretos.')</script>";
        }
    
    }
?>