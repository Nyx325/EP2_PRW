
<?php  include 'C:/xampp/htdocs/EP2_PRW/src/config/database.php';
?>
<?php
if(isset($_GET['id'])){
    $ID=$_GET['id'];
    $sql="delete from citas where idcitas=$ID";
    $execute=mysqli_query($conn,$sql);
    sleep(3);
    header("Location:eliminar_act.php");
    if($result){
        echo "Servicio eliminado";
    }else{
        echo "Error al eliminar el servicio";
    }
}
?>

