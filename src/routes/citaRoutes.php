<?php

require '../models/cita.php';

function getCitas(): string {
    $repo = new RepositorioCitas();
    try {
        $result = $repo->buscarCitas();
        return json_encode(['success' => true, 'data' => $result]);
    } catch (\Throwable $th) {
        return json_encode(['success' => false, 'error' => [
            'message' => $th->getMessage(),
            'file' => $th->getFile(),
            'line' => $th->getLine(),
            'code' => $th->getCode()
        ]]);
    }
}

function updateCita($data): string {
    if (!isset($data['cita']['id']) || !isset($data['cita']['cliente']) || !isset($data['cita']['servicio']) || !isset($data['cita']['fecha'])) {
        return json_encode(['success' => false, 'error' => "Faltan campos"]);
    }

    try {
        $cita = new Cita($data['cita']['id'], $data['cita']['cliente'], $data['cita']['servicio'], $data['cita']['fecha']);
        $repo = new RepositorioCitas();
        $repo->update($cita);
        return json_encode(['success' => true]);
    } catch (\Throwable $th) {
        return json_encode(['success' => false, 'error' => [
            'message' => $th->getMessage(),
            'file' => $th->getFile(),
            'line' => $th->getLine(),
            'code' => $th->getCode()
        ]]);
    }
}

function deleteCita(): string {
    if (!isset($_GET['id'])) {
        return json_encode(["success" => false, "error" => "No se especificó registro"]);
    }

    $repo = new RepositorioCitas();

    try {
        $repo->delete($_GET['id']);
        return json_encode(['success' => true, "message" => $_GET['id']]);
    } catch (\Throwable $th) {
        return json_encode(['success' => false, 'error' => [
            'message' => $th->getMessage(),
            'file' => $th->getFile(),
            'line' => $th->getLine(),
            'code' => $th->getCode()
        ]]);
    }
}

function createCita($data) {
    if (!isset($data['cita']['cliente']) || !isset($data['cita']['servicio']) || !isset($data['cita']['fecha'])) {
        return json_encode(["success" => false, "error" => "Faltan campos"]);
    }

    try {
        $cita = new Cita(0, $data['cita']['cliente'], $data['cita']['servicio'], $data['cita']['fecha']);
        $repo = new RepositorioCitas();
        $repo->agregarCita($cita);
        return json_encode(['success' => true]);
    } catch (\Throwable $th) {
        return json_encode(['success' => false, 'error' => [
            'message' => $th->getMessage(),
            'file' => $th->getFile(),
            'line' => $th->getLine(),
            'code' => $th->getCode()
        ]]);
    }
}

function main() {
    $data = json_decode(file_get_contents('php://input'), true);

    if (!isset($_SERVER['REQUEST_METHOD'])) {
        echo json_encode(['success' => false, 'error' => "No method"]);
        return;
    }

    $method = $_SERVER['REQUEST_METHOD'];

    switch ($method) {
        case 'GET':
            $response = getCitas();
            break;

        case 'POST':
            $response = createCita($data);
            break;

        case 'PUT':
            $response = updateCita($data);
            break;

        case 'DELETE':
            $response = deleteCita();
            break;

        default:
            $response = json_encode(['success' => false, 'error' => "Método no soportado"]);
            break;
    }

    echo $response;
}

main();