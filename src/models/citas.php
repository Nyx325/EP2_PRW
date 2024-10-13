<?php

class Cita {
    public $id;
    public $cliente;
    public $servicio;
    public $fecha;

    public function __construct($id, $cliente, $servicio, $fecha) {
        $this->id = $id;
        $this->cliente = $cliente;
        $this->servicio = $servicio;
        $this->fecha = $fecha;
    }
}

class RepositorioCitas {
    private $conn;

    // Constructor to establish a database connection
    public function __construct() {
        $this->conn = new PDO("mysql:host=localhost;dbname=nombre_basededatos", "usuario", "contraseña");
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    // Method to add a new appointment
    public function agregarCita(Cita $cita) {
        $stmt = $this->conn->prepare("INSERT INTO citas (cliente, servicio, fecha) VALUES (:cliente, :servicio, :fecha)");
        $stmt->bindParam(':cliente', $cita->cliente);
        $stmt->bindParam(':servicio', $cita->servicio);
        $stmt->bindParam(':fecha', $cita->fecha);
        $stmt->execute();
        $cita->id = $this->conn->lastInsertId(); // Get the last inserted ID
        return $cita;
    }

    // Method to retrieve all appointments
    public function buscarCitas() {
        $stmt = $this->conn->query("SELECT * FROM citas");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Method to update an existing appointment
    public function update(Cita $cita) {
        $stmt = $this->conn->prepare("UPDATE citas SET cliente = :cliente, servicio = :servicio, fecha = :fecha WHERE id = :id");
        $stmt->bindParam(':id', $cita->id);
        $stmt->bindParam(':cliente', $cita->cliente);
        $stmt->bindParam(':servicio', $cita->servicio);
        $stmt->bindParam(':fecha', $cita->fecha);
        $stmt->execute();
    }

    // Method to delete an appointment
    public function delete($id) {
        $stmt = $this->conn->prepare("DELETE FROM citas WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }
}
