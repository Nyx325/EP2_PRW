<?php include 'C:/xampp/htdocs/EP2_PRW/src/config/database.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Citas</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/styles.css"> <!-- Enlace al archivo CSS -->
</head>
<body>

<div class="container mt-5">
    <h2 class="text-center mb-4">Lista de Citas de Barbería</h2>
    <table class="table table-dark table-sm table-striped table-bordered">
        <thead>
            <tr>
                <th>Id</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Fecha</th>
                <th>Hora</th>
            </tr>
        </thead>
        <tbody>
        <?php
            $sql = "SELECT * FROM citas";
            $exec = mysqli_query($conn, $sql);
            while ($rows = mysqli_fetch_array($exec)) {
        ?>
            <tr>
                <td><?php echo $rows['idcitas']; ?></td>
                <td><?php echo $rows['nombre']; ?></td>
                <td><?php echo $rows['apellido']; ?></td>
                <td><?php echo $rows['fecha']; ?></td>
                <td><?php echo $rows['hora']; ?></td>
            </tr>
        <?php
            }
            mysqli_close($conn);
        ?>
        </tbody>
    </table>
    <a href="menuCitas.html" class="btn btn-primary mt-3">
            <i class="fas fa-arrow-left"></i> Regresar al Menú Principal
        </a>
</div>

<!-- Scripts de Bootstrap -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

