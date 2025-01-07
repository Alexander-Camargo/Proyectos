<?php
// encoder_decoder.php
final class EncoderDecoder {
    private $db;

    public function __construct($host, $user, $password, $dbname, $port = 3307) {
        $this->db = new mysqli($host, $user, $password, $dbname, $port);
        if ($this->db->connect_error) {
            die("Conexión fallida: " . $this->db->connect_error);
        }

        // Verificar e insertar el administrador por defecto
        $this->insertDefaultAdmin();
    }

    public static function encrypt($password) {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    private function insertDefaultAdmin() {
        // Verificar si el administrador ya existe
        $query = "SELECT id_usuario FROM usuarios WHERE correo = 'admin@example.com'";
        $result = $this->db->query($query);

        if ($result->num_rows === 0) {
            // Insertar administrador por defecto
            $hashedPassword = self::encrypt('root2514');
            $stmt = $this->db->prepare("
                INSERT INTO usuarios (nombre, correo, contrasena, rol, estado) 
                VALUES ('admin', 'admin@example.com', ?, 'administrador', 'activo')
            ");
            $stmt->bind_param("s", $hashedPassword);
            $stmt->execute();
            $stmt->close();
        }
    }

    public function verify() {
        session_start();  // Inicia la sesión

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $correo = filter_input(INPUT_POST, 'correo', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $contrasena = filter_input(INPUT_POST, 'contrasena', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            if (empty($correo) || empty($contrasena)) {
                echo "<p style='color:red;'>Por favor, ingresa tanto el correo como la contraseña.</p>";
                return;
            }

            $stmt = $this->db->prepare("SELECT contrasena, nombre, rol, id_usuario, estado FROM usuarios WHERE correo = ?");
            $stmt->bind_param("s", $correo);
            $stmt->execute();
            $stmt->bind_result($hashed_password, $nombre, $rol, $id_usuario, $estado);
            $stmt->fetch();

            $_SESSION['id_usuario'] = $id_usuario;

            if ($hashed_password !== null && password_verify($contrasena, $hashed_password) && $estado == 'activo') {
                $_SESSION['correo'] = $correo;
                $_SESSION['nombre'] = $nombre;
                $_SESSION['rol'] = $rol;  // Asegúrate de guardar el rol en la sesión

                // Verifica el rol y redirige al lugar adecuado
                if ($_SESSION['rol'] == "estudiante") {
                    header("Location: vistas/home_est.php");  // Ajusta la ruta si es necesario
                } elseif ($_SESSION['rol'] == "administrador") {
                    header("Location: vistas/home_admin.php");  // Ajusta la ruta si es necesario
                } else {
                    echo "<p style='color:red;'>Rol desconocido.</p>";
                }
                exit();  // Asegúrate de llamar a exit() después de header()
            } else {
                echo "<p style='color:red;'>Correo o contraseña incorrectos.</p>";
            }

            $stmt->close();
        }
    }

    public function closeConnection() {
        $this->db->close();
    }
}
?>
