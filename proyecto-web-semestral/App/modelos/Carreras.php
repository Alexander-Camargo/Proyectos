<?php
class Carreras {
    private $conn;

    public function __construct($host, $user, $password, $dbname, $port = 3307) {
        $this->conn = new mysqli($host, $user, $password, $dbname, $port);
        if ($this->conn->connect_error) {
            die("Conexión fallida: " . $this->conn->connect_error);
        }
    }

    public function obtenerCarreras() {
        $sql = "SELECT * FROM carreras";
        $result = $this->conn->query($sql);

        $carreras = [];
        while ($row = $result->fetch_assoc()) {
            $carreras[] = $row;
        }
        return $carreras;
    }

    public function agregarCarrera($nombre, $codigo) {
        $sql = "INSERT INTO carreras (nombre_carrera, codigo_carrera) VALUES (?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('ss', $nombre, $codigo);
        return $stmt->execute();
    }
}
?>
