<?php
$host = "localhost";
$usr = "root";
$pwd = "";
$db = "barberia";

<<<<<<< HEAD
$conn = mysqli_connect($host, $usr, $pwd, $db); 
?>
=======
$conn = mysqli_connect($host, $usr, $pwd, $db);

// Verificar la conexión
if (!$conn) {
  die("Error de conexión: " . mysqli_connect_error()); // Salir si hay un error en la conexión
}
>>>>>>> user-menu
