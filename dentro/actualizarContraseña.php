<?php
  //llamamos la conexion a la base de datos
  require '../database.php';

  if (isset($_SESSION['user_id'])) {
    //hacemos una consulta a la base de datos 
    $records = $conn->prepare('SELECT id, password, password FROM users WHERE id = :id');
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
  $message = '';
//validamos si los campos que resivo por el metodo POST no estan vacios 
 if(!empty($user)){

  if ( $user['password']== ':password') {
    $sql = "UPDATE users SET password,':password' WHERE password = ':password' ";
    $stmt = $conn->prepare($sql);
    //ciframos la contraseña del usuario antes de pasarla
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    //vinculamos la contraseña 
    $stmt->bindParam(':password', $password);
    
    if ($stmt->execute()) {
      $message = 'Successfully created new user';
      header("Location: /php-login-simple-master/dentro");
    } else {
      $message = 'Sorry there must have been an issue creating your account';
    }
  }
} 
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>SignUp</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
  </head>
  
  <body>
  <header> <?php require "menu.php"?></header>
    <br><br><br>
   
    <!-- imprimimos el mensaje de error o de aceptacion de usuario -->
    <?php if(!empty($message)): ?>
      <p> <?= $message ?></p>
    <?php endif; ?> 

        <h2>actualizar informacion</h3>
      
    
    <form action="actualizarContraseña.php" method="POST">
        <input name="password" type="password" placeholder="ingresa tu contraseña"required>
        <input name="password" type="password" placeholder="ingresa tu nueva contraseña"required>
        <input type="submit" value="Submit">
    </form>

  </body>
</html>


