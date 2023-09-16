<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>mudar senha</title>
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
        <img src="../view/img/rr.jpeg" alt="" width="72" height="57">
        <h1 class="h3 mb-3 fw-normal">mudar senha </h1>

        <form method="post" id="meuFormulario" onsubmit="return verificarFormulario()">
            <div class="form-floating">
                <label for="floatingInput">Email</label>
                <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" name="email">
            </div>
            <div class="form-floating">
                <label for="floatingPassword"> Nova Senha</label>
                <input type="password" class="form-control" id="floatingPassword" placeholder="senha123qwerty" name="password">
            </div>

            <div class="form-check text-start">
                <input class="form-check-input" type="checkbox" value="remember-me" id="flexCheckDefault">
                <label class="form-check-label" for="flexCheckDefault">
                    Lembre-me
                </label </div>
                <button class="btn btn-primary w-100 py-2" name="mudar" type="submit">ok</button>
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

if (isset($_POST['mudar'])) {
    $email = $mysqli->real_escape_string($_POST['email']);
    $password = $mysqli->real_escape_string($_POST['password']);
    $senha = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $mysqli->prepare("UPDATE  tb_login SET senha = ? WHERE email = ? ");
    $stmt->bind_param("ss", $senha, $email);

    if ($stmt->execute()) {
        $stmt->store_result(); // Added this line
       
        if (!isset($_SESSION)) {
            session_start();
        }
       
        $_SESSION['nivel'] = 2;

        echo "<script>alert(' senha alterada !!! ')</script>";

        header("Location: questoes.php");
        exit();
    } else {
        echo "Erro ao mudar senha : " . $mysqli->error;
    }
    $stmt->close();
    $mysqli->close();
}

?>
