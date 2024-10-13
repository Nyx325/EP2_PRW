<?php include 'database.php' ?>
<?php
// Iniciar la sesión
session_start();
if (isset($_GET['action']) && $_GET['action'] === 'crearCita') {
  crearCita($conn);
}

function login($conn)
{
  $response = ['status' => 'error', 'message' => ''];
  $data = json_decode(file_get_contents('php://input'), true);

  if (!isset($data['user']['userName']) || !isset($data['user']['password'])) {
    $response['message'] = 'Por favor, proporciona un nombre de usuario y una contraseña.';
    echo json_encode($response);
    return;
  }

  $username = $data['user']['userName'];
  $password = $data['user']['password'];

  // Preparar la consulta para evitar inyección SQL
  $stmt = $conn->prepare("SELECT * FROM usuarios WHERE usuario = ? AND contrasena = ?");
  $stmt->bind_param("ss", $username, $password);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows === 0) {
    $response['message'] = 'Credenciales incorrectas';
    echo json_encode($response);
    return;
  }

  $row = $result->fetch_assoc();
  $_SESSION['username'] = $username;
  $_SESSION['tipo'] = $row['tipo'];

  $response['status'] = 'success';
  $response['message'] = 'Sesión iniciada';
  //redirigir a menuUs.html para usuarios ubicado en la carpeta views
  
  header('Location: /public/views/menuUs.html');
  echo json_encode($response);
}

function crearCita($conn) {
  $data = json_decode(file_get_contents('php://input'), true);

  if (!isset($data['nombre'], $data['apellido'], $data['hora'], $data['fecha'], $data['servicios'])) {
      echo json_encode(['status' => 'error', 'message' => 'Faltan datos para crear la cita.']);
      return;
  }

  $nombre = $data['nombre'];
  $apellido = $data['apellido'];
  $fecha = $data['fecha'];
  $hora = $data['hora'];
  $servicios = $data['servicios']; // Este es ahora texto, no un ID

  // Preparar la consulta
  $stmt = $conn->prepare("INSERT INTO reservaciones (nombre, apellido, hora, fecha, servicios) VALUES ($nombre,$apellido,$hora, $fecha,$servicios)");

  if (!$stmt) {
      echo json_encode(['status' => 'error', 'message' => 'Error en la preparación: ' . $conn->error]);
      return;
  }

  $stmt->bind_param("sssss", $nombre, $apellido, $hora, $fecha, $servicios);

  if ($stmt->execute()) {
    sleep(2);
      echo json_encode(['status' => 'success', 'message' => 'Cita creada con éxito.']);
  } else {
      echo json_encode(['status' => 'error', 'message' => 'Error al crear la cita: ' . $stmt->error]);
  }

  $stmt->close();
}

function isUserLogged()
{
  if (isset($_SESSION['username'])) {
    echo json_encode(['status' => 'success', 'username' => $_SESSION['username'], 'tipo' => $_SESSION['tipo']]);
  } else {
    echo json_encode(['status' => 'error', 'message' => 'No hay sesion activa']);
  }
}

function logOut()
{
  session_unset();
  session_destroy();
  echo json_encode(['message' => 'Sesion cerrada']);
}

function main($conn)
{
  // Obtener el método HTTP
  $method = $_SERVER['REQUEST_METHOD'];

  switch ($method) {
    case 'POST':
      if (isset($_GET['action']) && $_GET['action'] === 'login') {
        login($conn);
    } else {
        crearCita($conn);
    }
    break;

    case 'GET':
      isUserLogged();
      break;

    case 'DELETE':
      logOut();
      break;

    default:
      echo json_encode(['status' => 'error', 'message' => 'Opción no válida']);
      break;
  }
}

main($conn);
