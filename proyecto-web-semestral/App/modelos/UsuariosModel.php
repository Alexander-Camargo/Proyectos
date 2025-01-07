<?php

class UsuariosModel {
    private $conn;

    public function __construct($host, $user, $password, $dbname, $port = 3307) {
        $this->conn = new mysqli($host, $user, $password, $dbname, $port);
        if ($this->conn->connect_error) {
            die("Conexión fallida: " . $this->conn->connect_error);
        }
    }

    public function registrarUsuario($nombre, $correo, $contrasena, $matricula, $id_carrera) {
        try {
            $sql = "INSERT INTO usuarios (nombre, correo, contrasena, matricula, id_carrera, rol, estado)
                    VALUES (?, ?, ?, ?, ?, 'estudiante', 'activo')";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param('sssss', $nombre, $correo, $contrasena, $matricula, $id_carrera);
            return $stmt->execute();
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    public function obtenerCarreras() {
        $sql = "SELECT id_carrera, nombre_carrera FROM carreras";
        $result = $this->conn->query($sql);
        
        $carreras = [];
        if ($result->num_rows > 0) {
            // Llenar el arreglo con los resultados
            while ($row = $result->fetch_assoc()) {
                $carreras[] = $row;
            }
        }

        return $carreras;
    }
	
	public function obtenerDatosUsuario($id_usuario) {
		$sql = "SELECT u.nombre, u.correo, u.matricula, c.nombre_carrera
				FROM usuarios u
				LEFT JOIN carreras c ON u.id_carrera = c.id_carrera
				WHERE u.id_usuario = ?";
				
		$stmt = $this->conn->prepare($sql);
		$stmt->bind_param('i', $id_usuario);
		$stmt->execute();
		$result = $stmt->get_result();
		return $result->fetch_assoc();
	}

	public function actualizarDatosUsuario($id_usuario, $nombre, $correo) {
		try {
			$sql = "UPDATE usuarios SET nombre = ?, correo = ? WHERE id_usuario = ?";
			$stmt = $this->conn->prepare($sql);
			$stmt->bind_param('ssi', $nombre, $correo, $id_usuario);
			return $stmt->execute();
		} catch (Exception $e) {
			echo "Error: " . $e->getMessage();
			return false;
		}
	}
	
	public function actualizarEstadoUsuario($id_usuario, $estado) {
		try {
			$sql = "UPDATE usuarios SET estado = ? WHERE id_usuario = ?";
			$stmt = $this->conn->prepare($sql);
			$stmt->bind_param('si', $estado, $id_usuario);
			return $stmt->execute();
		} catch (Exception $e) {
			echo "Error: " . $e->getMessage();
			return false;
		}
	}
	
}

?>
