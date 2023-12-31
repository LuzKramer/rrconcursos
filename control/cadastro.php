<?php

include('conection.php');

if (isset($_POST['cadastrar'])) {
    $name = $mysqli->real_escape_string($_POST['name']);
    $email = $mysqli->real_escape_string($_POST['email']);
    $password = $mysqli->real_escape_string($_POST['password']);
    $senha = password_hash($password, PASSWORD_DEFAULT);

    // Check if the email is already registered
    $check_sql = "SELECT * FROM tb_login WHERE email = '$email'";
    $check_query = $mysqli->query($check_sql) or die("SQL code error: " . $mysqli->error);

    $existing_user = $check_query->num_rows;

    $user = $check_query->fetch_assoc();

    if ($existing_user > 0) {
        echo "<script>alert('erro ao cadastrar, email ja cadastrado ')</script>";
    } else {

        if ($mysqli->query("INSERT INTO tb_login (nome, email, senha) VALUES ('$name', '$email', '$senha')")) {
            $user = $check_query->fetch_assoc();
            if (!isset($_SESSION)) {
                session_start();
            
                $_SESSION['nome'] = $user['nome'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['nivel'] = 2;
            }

            header("Location: noticias.php");
            echo "<script>alert('Usuario cadastrado !!! ')</script>";

            exit();
        } else {
            echo "Erro ao cadastrar: " . $mysqli->error;
        }
    }
}
?>


<!DOCTYPE html>
<html>

<head>
    <title>Cadastro</title>
    <style>
        .princip {
            background: #58c24e;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            padding: 30px;
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

    <div class="princip">

        <div class="login-box">
            <img src="../view/img/rr.jpeg" alt="" width="72" height="57">
            <h1 class="h3 mb-3 fw-normal">Cadastro</h1>

            <form method="post" id="meuFormulario" onsubmit="return verificarFormulario()">
                <div class="form-floating">
                    <label for="floatingName">Nome</label>
                    <input type="text" class="form-control" id="floatingName" placeholder="Nome" name="name">
                </div>
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
                    <h4>tens conta ?<a href="../control/login.php">Faça login</a></h4>
                </div>
                <button class="btn btn-primary w-100 py-2" name="cadastrar" type="submit">cadastrar</button>
            </form>
            <h3><a href="logout.php">Logout</a></h3>

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