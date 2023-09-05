<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TOME</title>
    <link rel="stylesheet" href="../View/question.css">
</head>
<body>
    <header>

    </header>
    <main>

        // <?php
// $host = "localhost";
// $banco = "teste";
// $user = "root";
// $senha = "";

// $mysql = new mysqli($host, $user, $senha, $banco);
// if($mysql->connect_errno){
    //     echo "Deu erro aqui";
    // }
    
    include ("conection.php");
    $questao = "SELECT * FROM questoes as a1, alternativas as a2, disciplinas as a3 where a1.id_questao=a2.id_questao;";
    $query_questao = mysqli_query($mysqli, $questao);
    
    
    
    
    
    
    
    
    //Perguntas ------------------- --------------------- ------------------
    
    
    
    
    //Parte 2 - Valiando a resposta correta
    
    
    
    $cont = 0;
    while( $resultado = mysqli_fetch_assoc($query_questao) ){
        $contar = $cont + 1;
        $responder = $responder + $contar;
        $resultado['id_questao'] = $resultado['id_alternativa'];
        if($resultado['id_questao'] === $resultado['id_alternativa']){
            ?>
            <form action="" method="POST">
                <?php


$enunciado = $resultado['enunciado'];
$ano_questao = $resultado['ano'];
$disciplina_questao = $resultado['nome_disciplina'];
echo "<h1> $enunciado </h1>". " - ".  $disciplina_questao ." - Ano: " . $ano_questao . '<br>';
$imagem = $resultado['imagem'];
if($imagem != ""){
    echo "<img src='$imagem' alt='Imagem not found'> </img>". '<br>';
}
echo "Opções: ";
echo '<br>';
echo "<input type='radio' name='escolha' id='' value='". $resultado['txt_alt1']. "'>". $resultado['txt_alt1'] . '<br>';
echo "<input type='radio' name='escolha' id='' value='". $resultado['txt_alt2']. "'>". $resultado['txt_alt2'] . '<br>';
echo "<input type='radio' name='escolha' id='' value='". $resultado['txt_alt3']. "'>". $resultado['txt_alt3'] . '<br>';
echo "<input type='radio' name='escolha' id='' value='". $resultado['txt_alt4']. "'>". $resultado['txt_alt4'] . '<br>';
echo "<input type='radio' name='escolha' id='' value='". $resultado['txt_alt5']. "'>". $resultado['txt_alt5'] . '<br>';
echo "<input type='submit' name='envio". $responder."' value='Enviar'>";
echo "<input type='reset' name='envio". $responder."' value='Apagar'>";
echo '<br>';
echo '<br>';
echo '<br>';
if(isset($_POST['envio'. $responder])){
    
    
    //Parte 2 -Verificação da resposta
    $certo = $resultado['correta'];
    $resposta_certa =  $resultado['txt_alt'. $certo];
    echo "A opção certa é: ". $resposta_certa. '<br>';
    $escolha = $_POST['escolha'];
    echo "Você marcou:  $escolha". '<br>';
    if($resposta_certa === $escolha){
        echo "Portanto, está certo(a)";
    }
    else{
        echo "Portanto, está errado(a)";
        
    }
}
?>
                                        </form>
                                        <?php
                    
                }
                
                else{
                    echo "Pergunta não encontrada";
                }
            }
            
            
            
            
            ?>
</main>
    </body>
    </html>