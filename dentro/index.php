<?php
//iniciamos la seccion
  session_start();
  //requerimos la coneccion a la base de datos
  require '../database.php';
  //validamos si existe la seccion 
  if (isset($_SESSION['user_id'])) {
    //hacemos una consulta a la base de datos 
    $records = $conn->prepare('SELECT identificacion, email, password FROM users WHERE identificacion = :id');
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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/styleMenu.css">
    <title>Document</title>
</head>
<header> <?php require "menu.php"?></header>
<body>
    
    
    <?php if(!empty($user)): ?>
        
      
    
    <?php else: ?>
      <h1>Please Login or SignUp</h1>

      <a href="login.php">Login</a> or
      <a href="signup.php">SignUp</a>
    <?php endif; ?>
</body>
</html>