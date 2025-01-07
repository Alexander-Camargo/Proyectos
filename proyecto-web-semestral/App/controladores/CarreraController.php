<?php
require_once '../modelos/Carreras.php';

class CarreraController {
    private $model;

    public function __construct() {
        $this->model = new Carreras('localhost', 'Alex_mysql', 'hollow2rojo6', 'bd_examen_ing_web', 3307);
    }

    public function obtenerCarreras() {
        return $this->model->obtenerCarreras();
    }

    public function agregarCarrera() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['agregarCarrera'])) {
            $nombre = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $codigo = filter_input(INPUT_POST, 'codigo', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            if ($nombre && $codigo) {
                $resultado = $this->model->agregarCarrera($nombre, $codigo);
                if ($resultado) {
                    header("Location: ../../App/vistas/moduloCarreras.php");
                    exit();
                } else {
                    echo "<p style='color: red;'>Error al agregar la carrera. Intenta nuevamente.</p>";
                }
            } else {
                echo "<p style='color: red;'>Todos los campos son obligatorios.</p>";
            }
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['agregarCarrera'])) {
    $controller = new CarreraController();
    $controller->agregarCarrera();
}
?>
