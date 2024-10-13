<?php
session_start();
    $user = $_POST['user-input'];
    $pass = $_POST['pwd-input'];

    $sql = "SELECT * FROM usuarios WHERE usuario = '$user' AND contrasena = '$pass';";
    $result = mysqli_query($conn, $sql);
    $rows = mysqli_fetch_assoc($result);

    if(($rows['usuario'] == $user) && ($rows['contrasena'] == $pass)){
        $_SESSION['user-input'] = $user;
        header("Location: menuUs.php");
    }elseif (($rows['usuario'] == "admin") && ($rows['contrasena'] == "123qaz")) {
        echo "ola";
    }else{
        header("Location: login.php");
    }
?>