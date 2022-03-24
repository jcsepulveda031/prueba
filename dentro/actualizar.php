<?php
  //llamamos la conexion a la base de datos
  require '../database.php';
  if (isset($_SESSION['user_id'])) {
    //hacemos una consulta a la base de datos 
    $records = $conn->prepare('SELECT id FROM users WHERE id = :id');
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
    $id = $user['user_id'];
  }
  


  // $sql = "UPDATE users SET nombre='$nombre',edad='$edad',telefono='$telefono' WHERE identificacion = '$id'";
  // $resultado = mysql_query($conn,$sql);
  $message = '';
//validamos si los campos que resivo por el metodo POST no estan vacios 
  if (!empty($_POST['identificacion']) || !empty($_POST['nombre']) || !empty($_POST['edad']) || !empty($_POST['telefono'])) {
    //si los campos estan llenos ahora puede insertar datos en la base de datos con el INSERT INTO
    
    $sql = "UPDATE users SET nombre=':nombre',edad=':edad',telefono=':telefono' WHERE identidicacion = '$user' ";
    //ejecutamos la anterior consulta de la base de datos con la anterior coneccion en database.php
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':nombre', $_POST['nombre']);
    $stmt->bindParam(':edad', $_POST['edad']);
    $stmt->bindParam(':telefono', $_POST['telefono']);
    
   
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
  <header> <?php require "menu.php"?></header>
  <body>
    <br><br><br>
   
  
        <h2>actualizar informacion</h3>
      <!-- creamos el formulario  -->
    <form action="actualizar.php" method="POST">
      <input name="nombre" type="text" placeholder="ingresa tu nombre">
      <div class="div-number">
      <input class="num" name="edad" type="int" placeholder="ingresa tu edad">
      </div>
      <div class="div-number">
      <input class="num" name="telefono" type="int" placeholder="ingresa tu telefono">
      </div>
      <input type="submit" value="Submit">
    </form>

  </body>
</html>
