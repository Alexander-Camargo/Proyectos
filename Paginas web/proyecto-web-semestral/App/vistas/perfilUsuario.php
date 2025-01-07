<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil - Usuario</title>
    <link rel="stylesheet" href="../../Public/css/styles.css">
	<style>
		.desactivar {
            justify-content: center; /* Centrar el botón */
			box-shadow: none;
            background-color: transparent; /* Hacer el fondo del formulario transparente */
        }
	</style>
</head>

<body>
    <header>
        <nav class="navbar">
            <h1>Sistema de Gestión</h1>
            <ul>
                <li><a href="home_est.php">Inicio</a></li>
                <li><a href="perfilUsuario.php">Perfil</a></li>
                <li><a href="logout.php">Cerrar Sesión</a></li>
            </ul>
        </nav>
    </header>
    <div class="container">
        <aside class="sidebar">
            <ul>
                <li><a href="moduloReservas.php">Catálogo de Libros</a></li>
                <li><a href="moduloLibros.php">Gestión de mis libros</a></li>
            </ul>
        </aside>
        <main class="content">
            <h2>Perfil del Usuario</h2>

            <!-- Información del usuario -->
            <?php
            require_once '../../App/modelos/UsuariosModel.php';
            session_start();
            $usuarioModel = new UsuariosModel('localhost', 'Alex_mysql', 'hollow2rojo6', 'bd_examen_ing_web', 3307);
            $usuarioId = $_SESSION['id_usuario'];

            $usuario = $usuarioModel->obtenerDatosUsuario($usuarioId);

            if ($usuario):
            ?>
                <form action="perfilUsuario.php" method="POST">
                    <label for="nombre">Nombre:</label>
                    <input class="login" type="text" id="nombre" name="nombre" value="<?= htmlspecialchars($usuario['nombre']) ?>" required>

                    <label for="correo">Correo:</label>
                    <input class="login" type="email" id="correo" name="correo" value="<?= htmlspecialchars($usuario['correo']) ?>" required>

                    <label for="matricula">Matrícula:</label>
                    <input class="login" type="text" id="matricula" name="matricula" value="<?= htmlspecialchars($usuario['matricula']) ?>" readonly>

                    <label for="carrera">Carrera:</label>
                    <input class="login" type="text" id="carrera" name="carrera" value="<?= htmlspecialchars($usuario['nombre_carrera']) ?>" readonly>

                    <input class="subir" type="submit" name="actualizar" value="Actualizar Datos">
                </form>

                <!-- Formulario para actualizar estado -->
                <form action="perfilUsuario.php" method="POST" style="margin-top: 20px;" class="desactivar">
                    <input type="hidden" name="estado" value="inactivo">
                    <input class="subir" type="submit" name="actualizar_estado" value="Desactivar Cuenta">
                </form>
            <?php else: ?>
                <p style="color: red;">No se encontraron datos del usuario.</p>
            <?php endif; ?>

            <?php
            // Procesar la actualización de datos
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['actualizar'])) {
                $nombre = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $correo = filter_input(INPUT_POST, 'correo', FILTER_VALIDATE_EMAIL);

                if ($nombre && $correo) {
                    $actualizado = $usuarioModel->actualizarDatosUsuario($usuarioId, $nombre, $correo);

                    if ($actualizado) {
                        echo "<p style='color: green;'>Datos actualizados correctamente.</p>";
                    } else {
                        echo "<p style='color: red;'>Error al actualizar los datos. Intenta nuevamente.</p>";
                    }
                } else {
                    echo "<p style='color: red;'>Todos los campos son obligatorios.</p>";
                }
            }

            // Procesar la actualización del estado
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['actualizar_estado'])) {
                $estado = filter_input(INPUT_POST, 'estado', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

                if ($estado === 'inactivo') {
                    $actualizadoEstado = $usuarioModel->actualizarEstadoUsuario($usuarioId, $estado);

                    if ($actualizadoEstado) {
                        header("Location: logout.php");
                        exit();
                    } else {
                        echo "<p style='color: red;'>Error al actualizar el estado. Intenta nuevamente.</p>";
                    }
                }
            }
            ?>
        </main>
    </div>
</body>

</html>