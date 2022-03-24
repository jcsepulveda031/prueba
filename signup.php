<?php
  //llamamos la conexion a la base de datos
  require 'database.php';

  $message = '';
//validamos si los campos que resivo por el metodo POST no estan vacios 
  if (!empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['identificacion'])) {
    //si los campos estan llenos ahora puede insertar datos en la base de datos con el INSERT INTO
    $sql = "INSERT INTO users (email, password,identificacion, nombre, edad, telefono) VALUES (:email, :password,:identificacion, :nombre,:edad, :telefono)";
   //ejecutamos la anterior consulta de la base de datos con la anterior coneccion en database.php
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':identificacion', $_POST['identificacion']);
    $stmt->bindParam(':nombre', $_POST['nombre']);
    $stmt->bindParam(':edad', $_POST['edad']);
    $stmt->bindParam(':telefono', $_POST['telefono']);
    //vinculamos la email  
    $stmt->bindParam(':email', $_POST['email']);
    //ciframos la contraseña del usuario antes de pasarla
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    //vinculamos la contraseña 
    $stmt->bindParam(':password', $password);
    //si todo funciona enviamos un mensaje al usuario si no se enviara un mensaje 
    if ($stmt->execute()) {
      $message = 'Successfully created new user';
    } else {
      $message = 'Sorry there must have been an issue creating your account';
    }
    
  }
  
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>SignUp</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
  </head>
  <body>

    <?php require 'partials/header.php' ?>
    <!-- imprimimos el mensaje de error o de aceptacion de usuario -->
    <?php if(!empty($message)): ?>
      <p> <?= $message ?></p>
    <?php endif; ?>

    <h1>SignUp</h1>

    <span>or <a href="login.php">Login</a></span>
      <!-- creamos el formulario  -->
    <form action="signup.php" method="POST">
    <input name="nombre" type="text" placeholder="ingresa tu nombre">
      <div class="div-number">
      <input  name="identificacion" type="int" placeholder="ingresa tu identidicacion">
      </div>
      <div class="div-number">
      <input class="num" name="edad" type="int" placeholder="ingresa tu edad">
      </div>
      <div class="div-number">
      <input class="num" name="telefono" type="int" placeholder="ingresa tu telefono">
      </div>
      <input name="email" type="text" placeholder="ingresa tu usuario" required>
      <input name="password" type="password" placeholder="ingresa tu contraseña"required>
      <input type="submit" value="Submit">
    </form>

  </body>
</html>
