<?php
require 'connector.php';

class Servicio
{
  public int $id;
  public string $servicio;
  public float $precio;

  public function __construct(int $id, string $servicio, float $precio)
  {
    $this->id = $id;
    $this->servicio = $servicio;
    $this->precio = $precio;
  }
}

class ServicioBusqueda
{
  public ?int $id;
  public ?string $servicio;
  public ?float $precio;

  public function __construct()
  {
    $this->id = null;
    $this->servicio = null;
    $this->precio = null;
  }
}

class RepositorioServicios
{
  private readonly Connector $connector;

  public function __construct()
  {
    $this->connector = new Connector();
  }

  public function agregarServicio(Servicio $serv): bool
  {
    $conn = $this->connector->getConnection();

    $query = "INSERT INTO servicios (servicio, precio) VALUES (?, ?)";
    $stmt = mysqli_prepare($conn, $query);

    if (!$stmt) {
      throw new Exception("Error preparando la consulta: " . mysqli_error($conn));
    }

    if (!mysqli_stmt_bind_param($stmt, "sd", $serv->servicio, $serv->precio)) {
      throw new Exception("Error vinculando parámetros: " . mysqli_stmt_error($stmt));
    }

    if (!mysqli_stmt_execute($stmt)) {
      throw new Exception("Error ejecutando la consulta: " . mysqli_stmt_error($stmt));
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);

    return true;
  }

  public function update(Servicio $serv): bool
  {
    $conn = $this->connector->getConnection();

    $query = "UPDATE servicios SET servicio = ?, precio = ? WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query);

    if (!$stmt) {
      throw new Exception("Error preparando la consulta: " . mysqli_error($conn));
    }

    if (!mysqli_stmt_bind_param($stmt, "sdi", $serv->servicio, $serv->precio, $serv->id)) {
      throw new Exception("Error vinculando parámetros: " . mysqli_stmt_error($stmt));
    }

    if (!mysqli_stmt_execute($stmt)) {
      throw new Exception("Error ejecutando la consulta: " . mysqli_stmt_error($stmt));
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);

    return true;
  }

  public function delete(int $id): bool
  {
    $conn = $this->connector->getConnection();

    $query = "DELETE FROM servicios WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query);

    if (!$stmt) {
      throw new Exception("Error preparando la consulta: " . mysqli_error($conn));
    }

    if (!mysqli_stmt_bind_param($stmt, "i", $id)) {
      throw new Exception("Error vinculando parámetros: " . mysqli_stmt_error($stmt));
    }

    if (!mysqli_stmt_execute($stmt)) {
      throw new Exception("Error ejecutando la consulta: " . mysqli_stmt_error($stmt));
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);

    return true;
  }

  public function buscarServicios(ServicioBusqueda $busqueda): array
  {
    $conn = $this->connector->getConnection();

    $query = "SELECT * FROM servicios WHERE 1=1";
    $params = [];
    $paramTypes = "";

    if (!is_null($busqueda->id)) {
      $query .= " AND id = ?";
      $params[] = $busqueda->id; // Notación para indicar un push al array
      $paramTypes .= "i";
    }

    if (!is_null($busqueda->servicio)) {
      $query .= " AND servicio LIKE ?";
      $params[] = "%" . $busqueda->servicio . "%";
      $paramTypes .= "s";
    }

    if (!is_null($busqueda->precio)) {
      $query .= " AND precio = ?";
      $params[] = $busqueda->precio;
      $paramTypes .= "d";
    }

    $stmt = mysqli_prepare($conn, $query);

    if (!$stmt) {
      throw new Exception("Error preparando la consulta: " . mysqli_error($conn));
    }

    if ($params) {
      if (!mysqli_stmt_bind_param($stmt, $paramTypes, ...$params)) {
        throw new Exception("Error vinculando parámetros: " . mysqli_stmt_error($stmt));
      }
    }

    if (!mysqli_stmt_execute($stmt)) {
      throw new Exception("Error ejecutando la consulta: " . mysqli_stmt_error($stmt));
    }

    $result = mysqli_stmt_get_result($stmt);
    if (!$result) {
      throw new Exception("Error obteniendo el resultado: " . mysqli_stmt_error($stmt));
    }

    $servicios = [];
    while ($row = mysqli_fetch_assoc($result)) {
      $servicios[] = new Servicio($row['id'], $row['servicio'], (float)$row['precio']);
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);

    return $servicios;
  }
}
