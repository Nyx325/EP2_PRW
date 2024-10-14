<?php include '../../src/config/database.php'; ?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Lista de Citas</title>

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

  <!-- CSS Personalizado -->
  <link rel="stylesheet" href="../../assets/css/estilos.css">
</head>

<body>

  <div class="container">
    <div class="table-container">
      <h2>Lista de Citas de Barbería</h2>
      <table class="table table-striped table-hover table-bordered">
        <thead class="thead-dark">
          <tr>
            <th>Id</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Fecha</th>
            <th>Hora</th>
            <th>Servicio</th>
            <th>Eliminar</th>
            <th>Actualizar</th>
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
              <td><?php echo $rows['servicio']; ?></td>
              <td>
                <a href="eliminar.php?id=<?php echo $rows['idcitas']; ?>" class="btn-delete">
                  <i class="fas fa-trash-alt fa-lg"></i>
                </a>
              </td>
              <td>
                <a href="actualizar.php?id=<?php echo $rows['idcitas']; ?>" class="btn-update">
                  <i class="fas fa-edit fa-lg"></i>
                </a>
              </td>
            </tr>
          <?php
          }
          mysqli_close($conn);
          ?>
        </tbody>
      </table>
    </div>
    <a href="menuCitas.html" class="btn btn-primary mt-3">
      <i class="fas fa-arrow-left"></i> Regresar al Menú Principal
    </a>
  </div>

  <!-- Bootstrap Scripts -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
