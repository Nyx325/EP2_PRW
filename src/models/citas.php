<?php
require "connector.php";

class Cita
{
    public string $nombre;
    public string $apellido;
    public string $fecha;
    public string $hora;
    public string $servicio;

    public function __construct(string $nombre, string $apellido, string $fecha, string $hora, string $servicio)
    {
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->fecha = $fecha;
        $this->hora = $hora;
        $this->servicio = $servicio;
    }
}

class RepositorioCita
{
    private Connector $connector;

    public function __construct()
    {
        $this->connector = new Connector();
    }

    public function agregarCita(Cita $cita)
    {
        $conn = $this->connector->getConnection();

        $stmt = $conn->prepare("INSERT INTO citas (nombre, apellido, fecha, hora, servicio) VALUES (?,?,?,?,?)");

        if (!$stmt) {
            throw new Exception('Error en la preparación: ' . $conn->error);
        }

        $stmt->bind_param("sssss", $cita->nombre, $cita->apellido, $cita->hora, $cita->fecha, $cita->servicio);

        if (!$stmt->execute()) {
            throw new mysqli_sql_exception('Error al crear la cita: ' . $stmt->error);
        }

        $stmt->close();
        $conn->close();
    }
}
