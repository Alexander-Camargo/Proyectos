<?php
// EstadisticasModel.php

class EstadisticasModel {
    private $conn;

    public function __construct() {
        $this->conn = new mysqli('localhost', 'Alex_mysql', 'hollow2rojo6', 'bd_examen_ing_web', 3307);
        if ($this->conn->connect_error) {
            die("Conexión fallida: " . $this->conn->connect_error);
        }
    }

    // Función para obtener los libros más usados en el último mes
    public function librosMasUsadosUltimoMes() {
        $sql = "SELECT l.titulo, COUNT(r.id_reserva) AS total_reservas
                FROM reservas r
                INNER JOIN libros l ON r.id_libro = l.id_libro
                WHERE r.fecha_entrega >= DATE_SUB(NOW(), INTERVAL 1 MONTH)
                GROUP BY l.titulo
                ORDER BY total_reservas DESC";
        $resultado = $this->conn->query($sql);

        $libros = [];
        if ($resultado->num_rows > 0) {
            while ($row = $resultado->fetch_assoc()) {
                $libros[] = $row;
            }
        }

        return $libros;
    }

    // Función para obtener los días con más reservas en el último mes
    public function diasConMasReservasUltimoMes() {
        $sql = "SELECT DATE(r.fecha_entrega) AS fecha, COUNT(r.id_reserva) AS total_reservas
                FROM reservas r
                WHERE r.fecha_entrega >= DATE_SUB(NOW(), INTERVAL 1 MONTH)
                GROUP BY fecha
                ORDER BY total_reservas DESC
                LIMIT 5";
        $resultado = $this->conn->query($sql);

        $dias = [];
        if ($resultado->num_rows > 0) {
            while ($row = $resultado->fetch_assoc()) {
                $dias[] = $row;
            }
        }

        return $dias;
    }

    // Función para obtener las reservas de un libro específico en el último mes
    public function reservasPorLibroUltimoMes($idLibro) {
        $sql = "SELECT COUNT(r.id_reserva) AS total_reservas
                FROM reservas r
                WHERE r.id_libro = ? AND r.fecha_entrega >= DATE_SUB(NOW(), INTERVAL 1 MONTH)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('i', $idLibro);
        $stmt->execute();
        $resultado = $stmt->get_result();

        $reservas = $resultado->fetch_assoc();

        return $reservas ? $reservas['total_reservas'] : 0;
    }
}
?>
