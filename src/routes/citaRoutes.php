<?php
require "../models/citas.php";

function agregarCita($data): string
{
    if (!isset($data['nombre'], $data['apellido'], $data['hora'], $data['fecha'], $data['servicio'])) {
        return json_encode(['status' => 'error', 'message' => 'Faltan datos para crear la cita.']);
    }

    try {
        $cita = new Cita($data['nombre'], $data['apellido'], $data['fecha'], $data['hora'], $data['servicio']);
        $repo = new RepositorioCita();
        $repo->agregarCita($cita);
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
    $response = json_encode(['success' => false, 'error' => 'Error inesperado']);
    $data = json_decode(file_get_contents('php://input'), true);
    if (is_null($data)) {
        echo json_encode(['success' => false, 'error' => 'Datos JSON inválidos.']);
        return;
    }

    if (!isset($_SERVER['REQUEST_METHOD'])) {
        echo json_encode(['success' => false, 'error' => "No method"]);
        return;
    }

    $method = $_SERVER['REQUEST_METHOD'];

    switch ($method) {
        case 'GET':

            break;

        case 'PUT':

            break;

        case 'POST':
            $response = agregarCita($data);
            break;

        case 'DELETE':

            break;

        default:
            # code...
            break;
    }

    echo $response;
}

main();
