<?php include 'C:/xampp/htdocs/EP2_PRW/src/config/database.php'; ?>
<?php
    session_start();
    session_destroy();
    header("Location: login.html");
    
?>
