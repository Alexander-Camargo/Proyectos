<?php
class LibrosModel {
    private $conn;

    public function __construct($host, $user, $password, $dbname, $port = 3307) {
        // Conectar a la base de datos
        $this->conn = new mysqli($host, $user, $password, $dbname, $port);
        if ($this->conn->connect_error) {
            die("Conexión fallida: " . $this->conn->connect_error);
        }
    }

    public function obtenerCategorias() {
        // Obtener todas las categorías de la base de datos
        $sql = "SELECT id_categoria, nombre_categoria FROM categorias";
        $resultado = $this->conn->query($sql);
        
        $categorias = [];
        if ($resultado->num_rows > 0) {
            while ($row = $resultado->fetch_assoc()) {
                $categorias[] = $row;
            }
        }

        return $categorias;
    }

    // Función para agregar un libro sin la imagen
    public function agregarLibro($titulo, $autor, $editorial, $anio, $categoriaId, $unidades) {
        try {
            $sql = "INSERT INTO libros (titulo, autor, editorial, anio, categoria_id, unidades_disponibles) 
                    VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param('ssssii', $titulo, $autor, $editorial, $anio, $categoriaId, $unidades);
            return $stmt->execute(); // Si se ejecuta correctamente, devuelve true
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
            return false; // Si ocurre un error, devuelve false
        }
    }
    
    public function obtenerLibrosConPaginacion($offset, $limite) {
        $sql = "SELECT * FROM libros LIMIT ? OFFSET ?";
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
