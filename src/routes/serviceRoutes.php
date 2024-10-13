<?php


require '../models/servicio.php';

// Por protocolo en una solicitud get la info
// se debe mandar por la url
function getServices(): string
{
  $repo = new RepositorioServicios();
  $criterioBusqueda = new ServicioBusqueda();

  if (isset($_GET['servicio']))
    $criterioBusqueda->servicio = $_GET['servicio'];

  if (isset($_GET['precio']))
    $criterioBusqueda->precio = $_GET['precio'];

  try {
    $result = $repo->buscarServicios($criterioBusqueda);
    return json_encode(['success' => true, 'data' => $result]);
  } catch (\Throwable $th) {
    // Extraer información útil del error
    $errorData = [
      'message' => $th->getMessage(),
      'file' => $th->getFile(),
      'line' => $th->getLine(),
      'code' => $th->getCode()
    ];
    return json_encode(['success' => false, 'error' => $errorData]);
  }
}

function updateService($data): string
{
  if (!isset($data['id']) || !isset($data['servicio']) || !isset($data['precio'])) {
    return json_encode(['success' => false, 'error' => "Faltan campos"]);
  }

  $servicio = new Servicio($data['id'], $data['servicio'], $data['precio']);
  $repo = new RepositorioServicios();
  try {
    $repo->update($servicio);
    return json_encode(['success' => true]);
  } catch (\Throwable $th) {
    // Extraer información útil del error
    $errorData = [
      'message' => $th->getMessage(),
      'file' => $th->getFile(),
      'line' => $th->getLine(),
      'code' => $th->getCode()
    ];
    return json_encode(['success' => false, 'error' => $errorData]);
  }
}

function deleteService(): string
{
  if (!isset($_GET['id'])) {
    return json_encode(["success" => false, "error" => "No se especificó registro"]);
  }

  $repo = new RepositorioServicios();

  try {
    $repo->delete($_GET['id']);
    return json_encode(['success' => true, "message" => $_GET['id']]);
  } catch (\Throwable $th) {
    // Extraer información útil del error
    $errorData = [
      'message' => $th->getMessage(),
      'file' => $th->getFile(),
      'line' => $th->getLine(),
      'code' => $th->getCode()
    ];
    return json_encode(['success' => false, 'error' => $errorData]);
  }
}

function createService($data)
{
  if (!isset($data['servicio']['servicio']) || !isset($data['servicio']['precio']))
    return json_encode(["success" => false, "error" => "Faltan campos"]);

  try {
    $servicio = new Servicio(0, $data['servicio']['servicio'], $data['servicio']['precio']);
    $repo = new RepositorioServicios();
    $repo->agregarServicio($servicio);
    return json_encode(['success' => true]);
  } catch (\Throwable $th) {
    // Extraer información útil del error
    $errorData = [
      'message' => $th->getMessage(),
      'file' => $th->getFile(),
      'line' => $th->getLine(),
      'code' => $th->getCode()
    ];
    return json_encode(['success' => false, 'error' => $errorData]);
  }
}

function main()
{
  $data = json_decode(file_get_contents('php://input'), true);

  if (!isset($_SERVER['REQUEST_METHOD'])) {
    echo json_encode(['success' => false, 'error' => "No method"]);
    return;
  }

  $method = $_SERVER['REQUEST_METHOD'];

  switch ($method) {
    case 'GET':
      $response = getServices();
      break;

    case 'POST':
      $response = createService($data);
      break;

    case 'PUT':
      $response = updateService($data);
      break;

    case 'DELETE':
      $response = deleteService();
      break;

    default:
      # code...
      break;
  }

  echo $response;
}

main();
