<?php
//iniciamos la seccion
  session_start();
  //requerimos la coneccion a la base de datos
  require 'database.php';
  //validamos si existe la seccion 
  if (isset($_SESSION['user_id'])) {
    //hacemos una consulta a la base de datos 
    $records = $conn->prepare('SELECT id, email, password FROM users WHERE id = :id');
    //vinculamos el dato de id
    $records->bindParam(':id', $_SESSION['user_id']);
    //ejecutamos
    $records->execute();
    //obtenemos los datos
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $user = null;
    //comprobamos si esta vacio llenamos la variable con los resultados 
    if (count($results) > 0) {
      $user = $results;
    }
  }
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Welcome to you WebApp</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
  </head>
  <body>
    <?php require 'partials/header.php' ?>

    <?php if(!empty($user)): ?>
      <br> Welcome. <?= $user['email']; ?>
      <br>You are Successfully Logged In
      <a href="logout.php">
        Logout
      </a>
    <?php else: ?>
      <h1>Please Login or SignUp</h1>

      <a href="login.php">Login</a> or
      <a href="signup.php">SignUp</a>
    <?php endif; ?>
  </body>
</html>
