<?php
require_once '../modelos/ReservasModel.php';

class ReservasController {
    private $model;

    public function __construct() {
        $this->model = new ReservasModel('localhost', 'Alex_mysql', 'hollow2rojo6', 'bd_examen_ing_web', 3307);
    }

    public function reservarLibro() {
        session_start();

        if (isset($_POST['reservar']) && isset($_POST['id_libro']) && isset($_SESSION['id_usuario'])) {
            $idLibro = intval($_POST['id_libro']);
            $idUsuario = intval($_SESSION['id_usuario']);

            // Intentar hacer la reserva
            if ($this->model->reservarLibro($idUsuario, $idLibro) && $this->model->actualizarInventario($idLibro, -1)) {
                header("Location: ../../App/vistas/moduloReservas.php?mensaje=Reserva exitosa");
            } else {
                header("Location: ../../App/vistas/moduloReservas.php?mensaje=Error al reservar");
            }
            exit();
        }
    }

    public function devolverLibro() {
        session_start();

        if (isset($_POST['devolver']) && isset($_POST['id_reserva']) && isset($_SESSION['id_usuario'])) {
            $idReserva = intval($_POST['id_reserva']);
            $idUsuario = intval($_SESSION['id_usuario']);

            // Intentar devolver el libro
            if ($this->model->devolverLibro($idReserva) && $this->model->actualizarInventarioPorReserva($idReserva, 1)) {
                header("Location: ../../App/vistas/moduloLibros.php?mensaje=Libro devuelto con éxito");
            } else {
                header("Location: ../../App/vistas/moduloLibros.php?mensaje=Error al devolver el libro");
            }
            exit();
        }
    }

    public function obtenerReservasUsuarioPaginadas($idUsuario, $paginaActual, $reservasPorPagina) {
        $offset = ($paginaActual - 1) * $reservasPorPagina;

        $reservas = $this->model->obtenerReservasPorUsuarioPaginadas($idUsuario, $offset, $reservasPorPagina);
        $totalReservas = $this->model->contarReservasPorUsuario($idUsuario);
        $totalPaginas = ceil($totalReservas / $reservasPorPagina);

        return [
            'reservas' => $reservas,
            'totalPaginas' => $totalPaginas,
        ];
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['reservar'])) {
    $controller = new ReservasController();
    $controller->reservarLibro();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['devolver'])) {
    $controller = new ReservasController();
    $controller->devolverLibro();
}

?>