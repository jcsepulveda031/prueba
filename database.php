 <?php
// llamamos la base de datos de nuestro phpMydmin
$server = 'localhost';
$username = 'root';
$password = '';
$database = 'php_login_database';

try {
  //conectamos la base de datos a nuestro proyecto
  $conn = new PDO("mysql:host=$server;dbname=$database;", $username, $password);
} catch (PDOException $e) {
  //si ocurre un error que acabe con el proceso
  die('Connection Failed: ' . $e->getMessage());
}

?> 
