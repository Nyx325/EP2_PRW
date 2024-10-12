<?php

class Connector
{
  public function getConnection(): mysqli
  {
    $host = "localhost";
    $usr = "rubenor";
    $pwd = "archsudoloco";
    $db = "barberia";

    $conn = mysqli_connect($host, $usr, $pwd, $db);

    // Verificar la conexión
    if (!$conn) {
      die("Error de conexión: " . mysqli_connect_error()); // Salir si hay un error en la conexión
    }

    return $conn;
  }
}
