<?php
  //inicializamos las secciones para poder utilizarlas
  session_start();
  //si la seccion esta inicializada me redireccione a una pagina 
  if (isset($_SESSION['user_id'])) {
    header('Location: /php-login-simple-master/dentro');
  }
  require 'database.php';
  //validamos que los campos no esten vacios 
  if (!empty($_POST['email']) && !empty($_POST['password'])) {
    //ejecutamos una consulta a la base de datos la cual consultara el email y la contraseña con la condicion de que email sea igual a :email 
    $records = $conn->prepare('SELECT identificacion, email, password FROM users WHERE email = :email');
    //vinculamos el metodo email
    $records->bindParam(':email', $_POST['email']);
    //ejecutamos la consulta
    $records->execute();
    //obtenemos los datos mediante el metodo fetch
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $message = '';
    //validamos si el resultado esta vacio si es > 0 verificamos la contraseña y la comparamos con la de la base de datos 
    if (count($results) > 0 && password_verify($_POST['password'], $results['password'])) {
      //almacenamos el id del usuario
      $_SESSION['user_id'] = $results['identificacion'];
      //redireccionamos a una pagina
      header("Location: /php-login-simple-master/dentro");
    } else {
      $message = 'Sorry, those credentials do not match';
    }
  }

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Login</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
  </head>
  <body>
    <?php require 'partials/header.php' ?>
    <!-- si hay un error que me imprima el error -->
    <?php if(!empty($message)): ?>
      <p> <?= $message ?></p>
    <?php endif; ?>

    <h1>Login</h1>
    <span>or <a href="signup.php">SignUp</a></span>

    <form action="login.php" method="POST">
      <input name="email" type="text" placeholder="Enter your email">
      <input name="password" type="password" placeholder="Enter your Password">
      <input type="submit" value="Submit">
    </form>
  </body>
</html>
