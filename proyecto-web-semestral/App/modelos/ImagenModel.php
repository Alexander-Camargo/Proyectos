<?php
// ImagenModel.php

class ImagenModel {

    private $conn;

    public function __construct($host, $user, $password, $dbname, $port = 3307) {
        // Conectar a la base de datos
        $this->conn = new mysqli($host, $user, $password, $dbname, $port);
        if ($this->conn->connect_error) {
            die("Conexión fallida: " . $this->conn->connect_error);
        }
    }

    // Método para guardar la ruta de la imagen en la base de datos
    public function guardarRutaImagen($idLibro, $ruta) {
        $query = "INSERT INTO imagenes_libros (id_libro, ruta_imagen) VALUES (?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('is', $idLibro, $ruta);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // Método para verificar si ya existe una imagen para el libro
    public function verificarImagenExistente($idLibro) {
        $query = "SELECT ruta_imagen FROM imagenes_libros WHERE id_libro = ? AND ruta_imagen IS NOT NULL";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('i', $idLibro);
        $stmt->execute();
        $stmt->store_result();

        // Si la consulta devuelve alguna fila, significa que ya hay una imagen asignada
        return $stmt->num_rows > 0;
    }

    // Método para obtener los libros desde la base de datos
    public function obtenerLibros() {
        // Obtener todas las categorías de la base de datos
        $sql = "SELECT id_libro, titulo FROM libros";
        $resultado = $this->conn->query($sql);
        
        $titulo = [];
        if ($resultado->num_rows > 0) {
            while ($row = $resultado->fetch_assoc()) {
                $titulo[] = $row;
            }
        }

        return $titulo;
    }
}


?>
