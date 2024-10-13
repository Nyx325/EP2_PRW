<?php
require "../models/citas.php";
require "../config/database.php";

ini_set('display_errors', 1);
error_reporting(E_ALL);

// Función para agregar una cita (sin cambios)
function agregarCita($data): string {
    if (!isset($data['nombre'], $data['apellido'], $data['hora'], $data['fecha'], $data['servicio'])) {
        return json_encode(['status' => 'error', 'message' => 'Faltan datos para crear la cita.']);
    }

    try {
        $cita = new Cita($data['nombre'], $data['apellido'], $data['fecha'], $data['hora'], $data['servicio']);
        $repo = new RepositorioCita();
        $repo->agregarCita($cita);
        return json_encode(['success' => true]);
    } catch (\Throwable $th) {
        $errorData = [
            'message' => $th->getMessage(),
            'file' => $th->getFile(),
            'line' => $th->getLine(),
            'code' => $th->getCode()
        ];
        return json_encode(['success' => false, 'error' => $errorData]);
    }
}

// Nueva función para listar citas
function listarCitas(): string {
    header('Content-Type: application/json');
    
    try {
        $repo = new RepositorioCita();
        $citas = $repo->listarCitas(); // Asegúrate de que esta función existe en tu repositorio
        return json_encode(['success' => true, 'citas' => $citas]);
    } catch (Exception $e) {
        return json_encode(['success' => false, 'error' => $e->getMessage()]);
    }
}

function editarCita($data) {
    header('Content-Type: application/json');

    // Lee el cuerpo de la solicitud
    $rawData = file_get_contents('php://input');
    $data = json_decode($rawData, true); // Decodifica a un array asociativo

    // Verifica si la decodificación fue exitosa
    if (json_last_error() !== JSON_ERROR_NONE) {
        echo json_encode(['success' => false, 'error' => 'Datos JSON inválidos.']);
        exit;
    }

    // Verifica que se hayan enviado todos los datos necesarios
    if (!isset($data['id'], $data['nombre'], $data['apellido'], $data['fecha'], $data['hora'], $data['servicio'])) {
        echo json_encode(['success' => false, 'error' => 'Faltan datos necesarios.']);
        exit;
    }

    // Lógica de edición
    require_once '../models/RepositorioCita.php';
    try {
        $repo = new RepositorioCita();
        $cita = new Cita($data['nombre'], $data['apellido'], $data['fecha'], $data['hora'], $data['servicio']);
        $repo->editarCita($data['id'], $cita);
        echo json_encode(['success' => true, 'message' => 'Cita actualizada correctamente.']);
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'error' => $e->getMessage()]);
    }

}
//Eliminar citas

function eliminarCita() {
    header('Content-Type: application/json'); // Asegura el encabezado JSON

    if (!isset($_GET['id'])) {
        echo json_encode(['success' => false, 'error' => 'ID de la cita no proporcionado.']);
        exit;
    }

    $id = intval($_GET['id']); // Convertir el ID a un entero

    require_once '../models/RepositorioCita.php';

    try {
        $repo = new RepositorioCita();
        $repo->eliminarCita($id); // Llamada al método del repositorio
        echo json_encode(['success' => true, 'message' => 'Cita eliminada correctamente.']);
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'error' => $e->getMessage()]);
    }
}


function main() {
    $response = json_encode(['success' => false, 'error' => 'Error inesperado']);
    $data = json_decode(file_get_contents('php://input'), true);
    
    $method = $_SERVER['REQUEST_METHOD'];

    switch ($method) {
        case 'GET':
            $response = listarCitas(); // Llama a la función que lista las citas
            break;

        case 'POST':
            $response = agregarCita($data);
            break;
            
        case 'PUT':
            editarCita($data);
            break;
            
        case 'DELETE':
            eliminarCita($data);
            break;

        default:
            break;
    }

    echo $response;
}

main();

