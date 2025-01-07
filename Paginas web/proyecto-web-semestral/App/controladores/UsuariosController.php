<?php

class UsuariosController {
    private $model;

    public function __construct() {
        // Cargar la clase UsuariosModel
        $this->model = new UsuariosModel('localhost', 'Alex_mysql', 'hollow2rojo6', 'bd_examen_ing_web', 3307);
    }

    // Mostrar el formulario de registro
    public function mostrarFormularioRegistro() {
        $carreras = $this->model->obtenerCarreras();  // Obtener todas las carreras
        require_once __DIR__ . '/../vistas/registroUsuario.php';  // Asegúrate de que el nombre del archivo sea correcto
    }
    

    // Procesar el registro
    public function registrar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $correo = filter_input(INPUT_POST, 'correo', FILTER_VALIDATE_EMAIL);
            $contrasena = filter_input(INPUT_POST, 'contrasena', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $matricula = filter_input(INPUT_POST, 'matricula', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $id_carrera = filter_input(INPUT_POST, 'id_carrera', FILTER_VALIDATE_INT);

            if ($nombre && $correo && $contrasena && $matricula && $id_carrera) {
                // Cifrar la contraseña
                $contrasenaHashed = password_hash($contrasena, PASSWORD_BCRYPT);

                // Insertar el usuario
                $resultado = $this->model->registrarUsuario($nombre, $correo, $contrasenaHashed, $matricula, $id_carrera);

                if ($resultado) {
                    echo "<p style='color:green;'>Usuario registrado con éxito.</p>";
                } else {
                    echo "<p style='color:red;'>Error al registrar el usuario. Por favor, intente nuevamente.</p>";
                }
            } else {
                echo "<p style='color:red;'>Todos los campos son obligatorios.</p>";
            }
        }
    }
}
