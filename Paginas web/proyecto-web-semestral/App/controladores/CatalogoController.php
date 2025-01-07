<?php
// CatalogoController.php

require_once '../modelos/CatalogoModel.php';

class CatalogoController {

    private $model;

    public function __construct() {
        $this->model = new CatalogoModel('localhost', 'Alex_mysql', 'hollow2rojo6', 'bd_examen_ing_web', 3307); // Datos de conexión
    }

    // Método para mostrar el catálogo de libros
    public function mostrarCatalogo() {
        // Obtener todos los libros con sus imágenes
        return $this->model->obtenerCatalogoLibros();
    }
	
	public function mostrarCatalogoPaginado($paginaActual, $librosPorPagina) {
		$offset = ($paginaActual - 1) * $librosPorPagina;

		$libros = $this->model->obtenerCatalogoPaginado($offset, $librosPorPagina);
		$totalLibros = $this->model->contarTotalLibros();
		$totalPaginas = ceil($totalLibros / $librosPorPagina);

		return [
			'libros' => $libros,
			'totalPaginas' => $totalPaginas,
		];
	}

}
?>
