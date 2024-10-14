<?php
include '../../src/config/database.php';
?>

<?php
$nombre = $_POST['nombre'];
$ap = $_POST['apellido'];
$fecha = $_POST['fecha'];
$hora = $_POST['hora'];
$servicio = $_POST['servicio'];
$sql = "insert into citas (nombre,apellido,fecha,hora,servicio) values ('$nombre','$ap','$fecha','$hora','$servicio')";
$execute = mysqli_query($conn, $sql);
sleep(3);
header("Location:createC.php");

?>
