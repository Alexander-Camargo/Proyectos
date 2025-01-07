<?php
class LoginController {
    private $encoderDecoder;

    public function __construct() {
        // Cargar la clase EncoderDecoder
        $this->encoderDecoder = new EncoderDecoder('localhost', 'Alex_mysql', 'hollow2rojo6', 'bd_examen_ing_web', 3307);
    }

    public function login() {
        // Mostrar el formulario
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            // Aquí se renderiza la vista del formulario de login
            require_once 'vistas/login.php';
        }

        // Verificar credenciales cuando el formulario sea enviado
        $this->encoderDecoder->verify();
    }

    public function close() {
        // Cerrar la conexión a la base de datos
        $this->encoderDecoder->closeConnection();
    }
}
?>
