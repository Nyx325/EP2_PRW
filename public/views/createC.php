<?php include '../../src/config/database.php'; ?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Incorporar Citas</title>
  <!-- Enlace a Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body class="bg-dark bg-gradient text-light">

  <div class="container mt-5">
    <h6 class="text-center">Incorpora citas</h6>
    <form method="POST" name="frm1" id="frm1" action="altacitas.php">
      <div class="form-group">
        <label for="nombre">Nombre cliente:</label>
        <input type="text" name="nombre" id="nombre" class="form-control" required>
      </div>
      <div class="form-group">
        <label for="apellido">Apellido cliente:</label>
        <input type="text" name="apellido" id="apellido" class="form-control" required>
      </div>
      <div class="form-group">
        <label for="fecha">Fecha de la cita:</label>
        <input type="date" name="fecha" id="fecha" class="form-control" required>
      </div>
      <div class="form-group">
        <label for="hora">Hora de la cita:</label>
        <input type="time" name="hora" id="hora" class="form-control" required>
      </div>
      <div class="form-group">
        <label for="servicio">Servicio:</label>
        <select name="servicio" id="servicio" class="form-control" required>
          <option value="">Selecciona un servicio</option>
          <?php
          if (!$conn) {
            die("Conexión fallida: " . mysqli_connect_error());
          }

          $sql = "SELECT * FROM servicios";
          $result = mysqli_query($conn, $sql);

          if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
              echo "<option value='{$row['nombre']}'>{$row['nombre']}</option>";
            }
          } else {
            echo "<option value=''>Error en la consulta: " . mysqli_error($conn) . "</option>";
          }
          mysqli_close($conn);
          ?>
        </select>
      </div>
      <button type="submit" class="btn btn-success btn-block">Crear cita</button>
    </form>
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
