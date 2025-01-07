<?php
// ImagenController.php
require_once __DIR__ . '/../modelos/ImagenModel.php';

class ImagenController {

    private $model;

    public function __construct() {
        $this->model = new ImagenModel('localhost', 'Alex_mysql', 'hollow2rojo6', 'bd_examen_ing_web', 3307); // Datos de conexión correctos
    }

    // Acción para subir imagen
    public function subirImagen() {
        if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] == 0) {
            $imagen = $_FILES['imagen'];
            $idLibro = $_POST['id_libro']; // Asegúrate de que este campo esté en tu formulario

            // Verificar si el libro ya tiene una imagen asignada
            if ($this->model->verificarImagenExistente($idLibro)) {
                header('Location: ../vistas/subir_imagen.php?mensaje=Ya se ha subido una imagen para este libro.');
                exit();
            }

            // Ruta de destino para guardar la imagen
            $directorioDestino = "../../Public/Assets/imagenes/img_libros/";

            // Verificar si la carpeta existe, si no, crearla
            if (!is_dir($directorioDestino)) {
                mkdir($directorioDestino, 0777, true);
            }

            // Obtener el nombre del archivo y generar una ruta única
            $nombreImagen = uniqid('libro_', true) . '.' . pathinfo($imagen['name'], PATHINFO_EXTENSION);
            $rutaDestino = $directorioDestino . $nombreImagen;

            // Validar que sea una imagen
            if (getimagesize($imagen['tmp_name']) !== false) {
                // Mover la imagen al directorio destino
                if (move_uploaded_file($imagen['tmp_name'], $rutaDestino)) {
                    // Guardar la ruta de la imagen en la base de datos
                    $this->model->guardarRutaImagen($idLibro, $rutaDestino);

                    // Redirigir con mensaje de éxito
                    header('Location: ../vistas/subir_imagen.php?mensaje=Imagen subida con éxito.');
                } else {
                    header('Location: ../vistas/subir_imagen.php?mensaje=Error al guardar la imagen.');
                }
            } else {
                header('Location: ../vistas/subir_imagen.php?mensaje=El archivo no es una imagen válida.');
            }
        } else {
            header('Location: ../vistas/subir_imagen.php?mensaje=No se ha seleccionado ninguna imagen.');
        }
    }

    // Método para obtener los libros desde la base de datos
    public function obtenerLibros() {
        return $this->model->obtenerLibros();
    }
}

// Solo ejecutar la acción si se indica en la URL
if (isset($_GET['action']) && $_GET['action'] == 'subirImagen') {
    $controlador = new ImagenController();
    $controlador->subirImagen();
}

?>

