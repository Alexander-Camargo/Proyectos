<!-- subir_imagen.php -->
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../Public/css/styles.css">
    <title>Subir Imagen</title>
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
                <li><a href="estadisticasLibros.php">Estadísticas</a></li>
                <br>
                <li><a href="../../App/usuarios/registro.php">Editar Usuario</a></li>
                <br>
                <li><a href="../../App/usuarios/F_E_reporte.php">Reporte de los libros</a></li>
                <br>
            </ul>
        </aside>

    <h2>Subir Imagen de Libro</h2>

    <?php
    // Mostrar mensaje de éxito o error
    if (isset($_GET['mensaje'])) {
        echo "<p>" . $_GET['mensaje'] . "</p>";
    }

    // Obtener los libros desde el controlador
    require_once '../controladores/ImagenController.php';
    $controller = new ImagenController();
    $libros = $controller->obtenerLibros();
    ?>

    <form action="../controladores/ImagenController.php?action=subirImagen" method="POST" enctype="multipart/form-data">
        <label for="titulo">Título:</label>
        <select class="login" name="id_libro" id="titulo" required>
            <?php foreach ($libros as $libro): ?>
                <option value="<?= $libro['id_libro']; ?>"><?= $libro['titulo']; ?></option>
            <?php endforeach; ?>
        </select><br>

        <label for="imagen">Seleccionar Imagen:</label>
        <input type="file" name="imagen" id="imagen" required><br>

        <button class="subir" type="submit">Subir Imagen</button>
    </form>

</body>

</html>