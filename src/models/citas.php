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

class RepositorioCita{
    private Connector $connector;

    public function __construct(){
        $this->connector = new Connector();
    }

    public function agregarCita(Cita $cita){
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

    public function listarCitas() {
        $conn = $this->connector->getConnection(); // Obtener la conexión
        $sql = "SELECT * FROM citas"; // Asegúrate de que esta tabla existe
        $result = $conn->query($sql); // Ejecutar la consulta

        if (!$result) {
            throw new Exception('Error en la consulta: ' . $conn->error);
        }
        
        return $result->fetch_all(MYSQLI_ASSOC); // Devuelve un array asociativo de citas
    }

    public function editarCita($id, Cita $cita) {
        $conn = $this->connector->getConnection();
    
        $stmt = $conn->prepare("UPDATE citas SET nombre=?, apellido=?, fecha=?, hora=?, servicio=? WHERE idcitas=?");
    
        if (!$stmt) {
            throw new Exception('Error en la preparación: ' . $conn->error);
        }
    
        $stmt->bind_param("sssssi", $cita->nombre, $cita->apellido, $cita->fecha, $cita->hora, $cita->servicio, $id);
    
        if (!$stmt->execute()) {
            throw new mysqli_sql_exception('Error al editar la cita: ' . $stmt->error);
        }
    
        $stmt->close();
        $conn->close();
    } 

    public function eliminarCita($id){
        $conn = $this->connector->getConnection();
        $stmt = $conn->prepare("DELETE FROM citas WHERE idcitas=?");

        
        if (!$stmt) {
            throw new Exception('Error en la preparación: '. $conn->error);
        }
        
        $stmt->bind_param("i", $id);
        
        if (!$stmt->execute()) {
            throw new mysqli_sql_exception('Error al eliminar la cita: '. $stmt->error);
        }
        
        $stmt->close();
        $conn->close();
        return true;
    }
    
    
}
