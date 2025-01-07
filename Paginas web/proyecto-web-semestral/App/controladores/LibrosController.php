<?php

require_once '../modelos/LibrosModel.php';

// Controlador para manejar las operaciones relacionadas con los libros
class LibrosController {
    private $model;

    // Constructor que crea una instancia del modelo
    public function __construct() {
        $this->model = new LibrosModel('localhost', 'Alex_mysql', 'hollow2rojo6', 'bd_examen_ing_web', 3307); // Asegúrate de poner los datos correctos para tu conexión
    }

    public function obtenerCategorias() {
        return $this->model->obtenerCategorias();
    }

    // Función para agregar un libro
    public function agregarLibro() {
        $mensaje = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Obtener los datos del formulario
            $titulo = htmlspecialchars(filter_input(INPUT_POST, 'titulo', FILTER_SANITIZE_STRING));
            $autor = htmlspecialchars(filter_input(INPUT_POST, 'autor', FILTER_SANITIZE_STRING));
            $editorial = htmlspecialchars(filter_input(INPUT_POST, 'editorial', FILTER_SANITIZE_STRING));
            $anio = filter_input(INPUT_POST, 'anio', FILTER_VALIDATE_INT);
            $categoriaId = filter_input(INPUT_POST, 'categoria', FILTER_VALIDATE_INT);
            $unidades = filter_input(INPUT_POST, 'unidades', FILTER_VALIDATE_INT);
            
            // Llamar al modelo para agregar el libro
            $agregado = $this->model->agregarLibro($titulo, $autor, $editorial, $anio, $categoriaId, $unidades);
            
            if ($agregado) {
                $mensaje = '¡Libro agregado exitosamente!';
            } else {
                $mensaje = 'Hubo un error al agregar el libro. Intenta nuevamente.';
            }
        }
        
        // Redirigir a la vista_libros.php con el mensaje
        header("Location: ../vistas/vista_libros.php?mensaje=" . urlencode($mensaje));
        exit();
    }

    public function obtenerLibrosPaginados($pagina, $limite = 5) {
        $offset = ($pagina - 1) * $limite; // Calcular el desplazamiento
        $libros = $this->model->obtenerLibrosConPaginacion($offset, $limite);
        $totalLibros = $this->model->contarTotalLibros();
        $totalPaginas = ceil($totalLibros / $limite); // Calcular el total de páginas
        
        return [
            'libros' => $libros,
            'totalPaginas' => $totalPaginas,
            'paginaActual' => $pagina
        ];
    }
}

// Verificar si hay una acción en el parámetro 'action'
if (isset($_GET['action'])) {
    $action = $_GET['action'];
    $controller = new LibrosController();

    // Ejecutar la acción correspondiente
    if ($action == 'agregarLibro') {
        $controller->agregarLibro();
    }
}

?>
