<?php
// Cargar las categorías y los libros desde el controlador
require_once '../controladores/LibrosController.php';
$librosController = new LibrosController();

// Obtener las categorías
$categorias = $librosController->obtenerCategorias();

// Configuración de la paginación
$pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1; // Página actual, por defecto es 1
$limite = 5; // Cantidad de libros por página
$paginacion = $librosController->obtenerLibrosPaginados($pagina, $limite);

$libros = $paginacion['libros']; // Libros obtenidos
$totalPaginas = $paginacion['totalPaginas']; // Total de páginas
$paginaActual = $paginacion['paginaActual']; // Página actual

// Obtener el mensaje de la URL, si está disponible
$mensaje = isset($_GET['mensaje']) ? $_GET['mensaje'] : '';
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Libros</title>
    <link rel="stylesheet" href="../../Public/css/styles.css">
</head>

<body>
    <header>
        <nav class="navbar">
            <h1>Sistema de Gestión</h1>
            <ul>
                <li><a href="home_admin.php">Inicio</a></li>
                <li><a href="perfilAdmin.php">Perfil</a></li>
                <li><a href="logout.php">Cerrar Sesión</a></li>
            </ul>
        </nav>
    </header>
    <div class="container">
        <aside class="sidebar">
            <ul>
                <br>
                <li><a href="vista_libros.php">Gestión de Libros</a></li>
                <br>
                <li><a href="catalogo.php">Catalogo de Libros</a></li>
                <br>
                <li><a href="moduloCarreras.php">Gestión de Carreras</a></li>
                <br>
                <li><a href="estadisticas.php">Estadísticas</a></li>
                <br>
                <li><a href="../../App/usuarios/registro.php">Editar Usuario</a></li>
                <br>
                <li><a href="../../App/usuarios/F_E_reporte.php">Reporte de los libros</a></li>
                <br>
            </ul>
        </aside>
        <main class="content">
            <h2>Gestión de Libros</h2>



            <?php
            // Mostrar el mensaje de éxito o error
            if (!empty($mensaje)) {
                echo "<p>$mensaje</p>";
            }
            ?>

            <!-- Formulario para agregar libro -->
            <form action="../controladores/LibrosController.php?action=agregarLibro" method="POST" enctype="multipart/form-data">
                <h2>Agregar un nuevo libro</h2>

                <label for="titulo">Título:</label>
                <input class="login" type="text" name="titulo" id="titulo" required><br>

                <label for="autor">Autor:</label>
                <input class="login" type="text" name="autor" id="autor" required><br>

                <label for="editorial">Editorial:</label>
                <input class="login" type="text" name="editorial" id="editorial" required><br>

                <label for="anio">Año:</label>
                <input class="login" type="number" name="anio" id="anio" required><br>

                <label for="categoria">Categoría:</label>
                <select class="login" name="categoria" id="categoria" required>
                    <?php foreach ($categorias as $categoria): ?>
                        <option value="<?= $categoria['id_categoria']; ?>"><?= $categoria['nombre_categoria']; ?></option>
                    <?php endforeach; ?>
                </select><br>

                <label for="unidades">Unidades disponibles:</label>
                <input class="login" type="number" name="unidades" id="unidades" required><br>
                <button class="subir" type="submit">Agregar Libro</button>
            </form>
            <br>
            <br>
            <a class="boton-carreras" href="subir_imagen.php">Subir imagenes de los Libros </a>

            <h2>Lista de Libros</h2>

            <table class="tabla-carreras" border="1">
                <thead>
                    <tr>
                        <th>Título</th>
                        <th>Autor</th>
                        <th>Editorial</th>
                        <th>Año</th>
                        <th>Categoría</th>
                        <th>Unidades</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($libros)): ?>
                        <?php foreach ($libros as $libro): ?>
                            <tr>
                                <td><?= $libro['titulo'] ?></td>
                                <td><?= $libro['autor'] ?></td>
                                <td><?= $libro['editorial'] ?></td>
                                <td><?= $libro['anio'] ?></td>
                                <td><?= $libro['categoria_id'] ?></td>
                                <td><?= $libro['unidades_disponibles'] ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7">No hay libros disponibles.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>

            <!-- Paginación -->
            <div>
                <?php if ($paginaActual > 1): ?>
                    <a href="?pagina=<?= $paginaActual - 1 ?>">Anterior</a>
                <?php endif; ?>

                <?php for ($i = 1; $i <= $totalPaginas; $i++): ?>
                    <a href="?pagina=<?= $i ?>" <?= $i == $paginaActual ? 'style="font-weight: bold;"' : '' ?>><?= $i ?></a>
                <?php endfor; ?>

                <?php if ($paginaActual < $totalPaginas): ?>
                    <a href="?pagina=<?= $paginaActual + 1 ?>">Siguiente</a>
                <?php endif; ?>
            </div>

            <?php if ($paginaActual < $totalPaginas): ?>
                <a href="?pagina=<?= $paginaActual + 1 ?>">Siguiente</a>
            <?php endif; ?>
    </div>
    </main>
    </div>
</body>

</html>