<?php
// Iniciar la sesión
session_start();

// Obtener el método HTTP
$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'POST') {
  $data = json_decode(file_get_contents('php://input'), true);

  if (!isset($data['user']['userName']) || !isset($data['user']['password'])) {
    echo json_encode(['status' => 'error', 'message' => 'Por favor, proporciona un nombre de usuario y una contraseña.']);
    return;
  }

  $username = $data['user']['userName'];
  $password = $data['user']['password'];

  // Validar las credenciales
  if ($username === 'root' && $password === '123') {
    $_SESSION['username'] = $username;
    echo json_encode(['status' => 'success', 'message' => 'Sesión iniciada', 'username' => $_SESSION['username']]);
  } else {
    echo json_encode(['status' => 'error', 'message' => 'Credenciales incorrectas']);
  }
}
