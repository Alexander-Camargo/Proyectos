<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil - Administrador</title>
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
            <h2>Perfil del Administrador</h2>

            <?php
            require_once '../../App/modelos/UsuariosModel.php';
            session_start();

            // Verificar que el usuario tenga el rol de administrador
            if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'administrador') {
                echo "<p style='color: red;'>Acceso denegado. Solo los administradores pueden acceder a esta página.</p>";
                exit();
            }

            $usuarioModel = new UsuariosModel('localhost', 'Alex_mysql', 'hollow2rojo6', 'bd_examen_ing_web', 3307);
            $adminId = $_SESSION['id_usuario']; // ID del administrador almacenado en la sesión

            $administrador = $usuarioModel->obtenerDatosUsuario($adminId);

            if ($administrador):
            ?>
                <form action="perfilAdmin.php" method="POST">
                    <label for="nombre">Nombre:</label>
                    <input class="login" type="text" id="nombre" name="nombre" value="<?= htmlspecialchars($administrador['nombre']) ?>" required>

                    <label for="correo">Correo:</label>
                    <input class="login" type="email" id="correo" name="correo" value="<?= htmlspecialchars($administrador['correo']) ?>" required>

                    <input class="subir" type="submit" name="actualizar" value="Actualizar Datos">
                </form>
            <?php else: ?>
                <p style="color: red;">No se encontraron datos del administrador.</p>
            <?php endif; ?>

            <?php
            // Procesar la actualización de datos
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['actualizar'])) {
                $nombre = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $correo = filter_input(INPUT_POST, 'correo', FILTER_VALIDATE_EMAIL);

                if ($nombre && $correo) {
                    $actualizado = $usuarioModel->actualizarDatosUsuario($adminId, $nombre, $correo);

                    if ($actualizado) {
                        echo "<p style='color: green;'>Datos actualizados correctamente.</p>";
                    } else {
                        echo "<p style='color: red;'>Error al actualizar los datos. Intenta nuevamente.</p>";
                    }
                } else {
                    echo "<p style='color: red;'>Todos los campos son obligatorios.</p>";
                }
            }
            ?>
        </main>
    </div>
</body>

</html>