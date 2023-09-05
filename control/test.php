<?php
session_start();

// Database connection details
$host = "localhost"; // Replace with your database host
$username = "root"; // Replace with your database username
$password = ""; // Replace with your database password
$dbname = "db_rrconcursos"; // Replace with your database name

// Create a connection to the database
$conexao = new mysqli($host, $username, $password, $dbname);

// Check if the connection was successful
if ($conexao->connect_error) {
    die("Failed to connect to MySQL: " . $conexao->connect_error);
}
?>

<!DOCTYPE html>
<html>
<head>
<style>
  /* Add your CSS styling here */
  .question-container {
    width: 80%;
    margin: 0 auto;
    padding: 20px;
    border: 1px solid #ccc;
  }
</style>
</head>
<body>
    <h1>hello world</h1>

<?php
// Retrieve questions from the database
$query = "SELECT * FROM questoes LIMIT 10"; // Change this query as needed
$result = mysqli_query($conexao, $query);

if ($result) {
  while ($row = mysqli_fetch_assoc($result)) {
    $enunciado = $row['enunciado'];
    $id_questao = $row['id_questao'];

    echo '<div class="question-container">';
    echo '<h3>Question:</h3>';
    echo '<p>' . $enunciado . '</p>';

    // Retrieve and display alternatives
    $alt_query = "SELECT * FROM alternativas WHERE id_questao = $id_questao";
    $alt_result = mysqli_query($conexao, $alt_query);

    if ($alt_result) {
      echo '<h3>Alternatives:</h3>';
      while ($alt_row = mysqli_fetch_assoc($alt_result)) {
        echo '<p>' . $alt_row['txt_alt1'] . '</p>';
        // Display other alternatives as needed
      }
    } else {
      echo 'Error retrieving alternatives.';
    }

    echo '</div>';
  }
} else {
  echo 'Error retrieving questions.';
}

// Close your database connection
mysqli_close($conexao);
?>

</body>
</html>
