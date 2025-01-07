<?php
class ReservasModel {
    private $conn;

    public function __construct($host, $user, $password, $dbname, $port = 3307) {
        $this->conn = new mysqli($host, $user, $password, $dbname, $port);
        if ($this->conn->connect_error) {
            die("Conexión fallida: " . $this->conn->connect_error);
        }
    }

    public function reservarLibro($idUsuario, $idLibro) {
        $sql = "INSERT INTO reservas (id_usuario, id_libro, cantidad_reservada, estado_reserva) 
                VALUES (?, ?, 1, 'reservado')";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ii", $idUsuario, $idLibro);
        return $stmt->execute();
    }

    public function actualizarInventario($idLibro, $cantidad) {
        $sql = "UPDATE libros SET unidades_disponibles = unidades_disponibles + ? WHERE id_libro = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ii", $cantidad, $idLibro);
        return $stmt->execute();
    }

    public function devolverLibro($idReserva) {
        $sql = "UPDATE reservas SET estado_reserva = 'devuelto', fecha_devolucion = CURRENT_TIMESTAMP 
                WHERE id_reserva = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $idReserva);
        return $stmt->execute();
    }

    public function actualizarInventarioPorReserva($idReserva, $cantidad) {
        $sql = "UPDATE libros l
                JOIN reservas r ON l.id_libro = r.id_libro
                SET l.unidades_disponibles = l.unidades_disponibles + ?
                WHERE r.id_reserva = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ii", $cantidad, $idReserva);
        return $stmt->execute();
    }

    public function obtenerReservasPorUsuarioPaginadas($idUsuario, $offset, $limite) {
        $sql = "SELECT r.id_reserva, r.cantidad_reservada, l.titulo, l.autor, i.ruta_imagen 
                FROM reservas r
                JOIN libros l ON r.id_libro = l.id_libro
                LEFT JOIN imagenes_libros i ON l.id_libro = i.id_libro
                WHERE r.id_usuario = ? AND r.estado_reserva = 'reservado'
                LIMIT ? OFFSET ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("iii", $idUsuario, $limite, $offset);
        $stmt->execute();
        $result = $stmt->get_result();

        $reservas = [];
        while ($row = $result->fetch_assoc()) {
            $reservas[] = $row;
        }

        return $reservas;
    }

    public function contarReservasPorUsuario($idUsuario) {
        $sql = "SELECT COUNT(*) AS total FROM reservas WHERE id_usuario = ? AND estado_reserva = 'reservado'";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $idUsuario);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return $row['total'];
    }
}

?>
