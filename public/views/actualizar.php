<?php  
include 'C:/xampp/htdocs/EP2_PRW/src/config/database.php';

if (isset($_GET['id'])) {
    $ID = $_GET['id'];
    $sql = "SELECT * FROM citas WHERE idcitas = $ID";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $nombre = $row['nombre'];
        $apellido = $row['apellido'];
        $hora = $row['hora'];
        $fecha = $row['fecha'];
        $servicio = $row['servicio'];
    } else {
        echo "No existe el ID.";
        exit();
    }
}

if (isset($_POST['actualizar'])) {
    // Capturamos los nuevos valores del formulario
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $hora = $_POST['hora'];
    $fecha = $_POST['fecha'];
    $servicio = $_POST['servicio'];

    // Consulta de actualización
    $sql = "UPDATE citas SET 
                nombre='$nombre', 
                apellido='$apellido', 
                fecha='$fecha', 
                hora='$hora', 
                servicio='$servicio' 
            WHERE idcitas = $ID";

    if (mysqli_query($conn, $sql)) {
        header("Location: eliminar_act.php");
        exit();  // Es importante usar exit() después del header
    } else {
        echo "Error al actualizar: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Cita</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body class="bg-dark text-white">

<div class="container mt-5">
    <h2>Actualizar Cita</h2>
    <form action="actualizar.php?id=<?php echo $_GET['id']; ?>" method="POST">
        <div class="form-group">
            <label>Nombre del cliente:</label>
            <input type="text" name="nombre" id="nombre" value="<?php echo $nombre; ?>" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Apellido del cliente:</label>
            <input type="text" name="apellido" id="apellido" value="<?php echo $apellido; ?>" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Fecha:</label>
            <input type="date" name="fecha" id="fecha" value="<?php echo $fecha; ?>" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Hora:</label>
            <input type="time" name="hora" id="hora" value="<?php echo $hora; ?>" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Servicio:</label>
            <select name="servicio" id="servicio" class="form-control" required>
                <option value="">Selecciona un servicio</option>
                <?php
                    $sql = "SELECT * FROM servicios";
                    $result = mysqli_query($conn, $sql);
                    if ($result) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $selected = ($servicio == $row['nombre']) ? "selected" : "";
                            echo "<option value='{$row['nombre']}' $selected>{$row['nombre']}</option>";
                        }
                    } else {
                        echo "<option>Error: " . mysqli_error($conn) . "</option>";
                    }
                ?>
            </select>
        </div>
        <button type="submit" name="actualizar" class="btn btn-success">Actualizar</button>
        <a href="menuCitas.html" class="btn btn-primary">Regresar al Menú</a>
    </form>
</div>

</body>
</html>
