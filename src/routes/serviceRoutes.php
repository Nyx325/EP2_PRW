<?php
require '../models/servicio.php';

// Por protocolo en una solicitud get la info
// se debe mandar por la url
function getServices(): string | false
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
      echo $response;
      break;

    default:
      # code...
      break;
  }
}

main();
