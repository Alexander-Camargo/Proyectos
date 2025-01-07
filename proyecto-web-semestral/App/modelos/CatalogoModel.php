<?php
// CatalogoModel.php

class CatalogoModel {

    private $conn;

    public function __construct($host, $user, $password, $dbname, $port = 3307) {
        // Conectar a la base de datos
        $this->conn = new mysqli($host, $user, $password, $dbname, $port);
        if ($this->conn->connect_error) {
            die("Conexión fallida: " . $this->conn->connect_error);
        }
    }

    // Método para obtener todos los libros con sus imágenes
    public function obtenerCatalogoLibros() {
        // Asegúrate de separar correctamente las columnas con comas
        $sql = "SELECT l.id_libro, l.titulo, l.autor, l.categoria_id, l.unidades_disponibles, i.ruta_imagen 
                FROM libros l
                LEFT JOIN imagenes_libros i ON l.id_libro = i.id_libro";
        $resultado = $this->conn->query($sql);

        $libros = [];
        if ($resultado->num_rows > 0) {
            while ($row = $resultado->fetch_assoc()) {
                $libros[] = $row;
            }
        }

        return $libros;
    }
	
	public function obtenerCatalogoPaginado($offset, $limite) {
		$sql = "SELECT l.id_libro, l.titulo, l.autor, l.categoria_id, l.unidades_disponibles, i.ruta_imagen 
				FROM libros l
				LEFT JOIN imagenes_libros i ON l.id_libro = i.id_libro
				LIMIT ? OFFSET ?";
		$stmt = $this->conn->prepare($sql);
		$stmt->bind_param("ii", $limite, $offset);
		$stmt->execute();
		$resultado = $stmt->get_result();

		$libros = [];
		if ($resultado->num_rows > 0) {
			while ($row = $resultado->fetch_assoc()) {
				$libros[] = $row;
			}
		}
		return $libros;
	}

	public function contarTotalLibros() {
		$sql = "SELECT COUNT(*) AS total FROM libros";
		$resultado = $this->conn->query($sql);
		$row = $resultado->fetch_assoc();
		return $row['total'];
	}

}
?>

