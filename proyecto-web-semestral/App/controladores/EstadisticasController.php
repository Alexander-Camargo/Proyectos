<?php
require_once '../modelos/EstadisticasModel.php';

class EstadisticasController {

    private $model;

    public function __construct() {
        // Conexión según los datos proporcionados
        $this->model = new EstadisticasModel('localhost', 'Alex_mysql', 'hollow2rojo6', 'bd_examen_ing_web', 3307);
    }

    public function librosMasUsadosUltimoMes() {
        return $this->model->librosMasUsadosUltimoMes();
    }

    public function fechasConMasReservasUltimoMes() { // Ajuste en el nombre del método
        return $this->model->diasConMasReservasUltimoMes(); // Aseguramos que este método exista en el modelo
    }

    public function reservasDeLibroEspecifico($id_libro) {
        return $this->model->reservasPorLibroUltimoMes($id_libro);
    }
}
?>
