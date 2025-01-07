<?php
session_start();

// Conexión a la base de datos
$connection = new mysqli('localhost', 'Alex_mysql', 'hollow2rojo6', 'bd_examen_ing_web', 3307);

if ($connection->connect_error) {
    die("Conexión fallida: " . $connection->connect_error);
}

// Verificar si se recibió el ID del usuario
if (isset($_GET['id'])) {
    $id_user = $_GET['id'];

    // Obtener los datos actuales del usuario
    $stmt = $connection->prepare("SELECT * FROM usuarios WHERE id_usuario = ?");
    $stmt->bind_param("i", $id_user);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    // Manejar la actualización del usuario
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nombre = $_POST['nombre'];
        $correo = $_POST['correo'];
        $matricula = $_POST['matricula'];
        $contrasena = $_POST['contrasena'];
        $estado = $_POST['estado'];

        // Si la contraseña se deja vacía, no actualizarla
        if (!empty($contrasena)) {
            $hashed_password = password_hash($contrasena, PASSWORD_DEFAULT); // Encriptar contraseña
            $stmt = $connection->prepare("UPDATE usuarios SET nombre = ?, correo = ?, matricula = ?, contrasena = ?, estado = ? WHERE id_usuario = ?");
            $stmt->bind_param("sssssi", $nombre, $correo, $matricula, $hashed_password, $estado, $id_user);
        } else {
            $stmt = $connection->prepare("UPDATE usuarios SET nombre = ?, correo = ?, matricula = ?, estado = ? WHERE id_usuario = ?");
            $stmt->bind_param("ssssi", $nombre, $correo, $matricula, $estado, $id_user);
        }

        if ($stmt->execute()) {
            header("Location: reporte.php");
            exit;
        } else {
            echo "Error al actualizar el usuario: " . $stmt->error;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Usuario</title>
    <link rel="stylesheet" href="../../Public/css/styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        form {
            width: 50%;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: none;
        }

        label {
            font-size: 16px;
            margin-bottom: 8px;
            display: block;
            color: #555;
        }

        input, select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }

        button:hover {
            background-color: #45a049;
        }

        a {
            display: inline-block;
            margin-top: 15px;
            text-decoration: none;
            color: #333;
            text-align: center;
        }

        a:hover {
            color: #4CAF50;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .form-container {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
    </style>
</head>
<body>
    <header>
        <nav class="navbar">
            <h1>Sistema de Gestión</h1>
            <ul>
                <li><a href="../../App/vistas/home_admin.php">Inicio</a></li>
                <li><a href="../../App/vistas/perfilAdmin.php">Perfil</a></li>
                <li><a href="../../App/vistas/logout.php">Cerrar Sesión</a></li>
            </ul>
        </nav>
    </header>
    <div class="container">
        <aside class="sidebar">
            <ul>
                <br>
                <li><a href="../../App/vistas/vista_libros.php">Gestión de Libros</a></li>
                <br>
                <li><a href="../../App/vistas/catalogo.php">Catálogo de Libros</a></li>
                <br>
                <li><a href="../../App/vistas/moduloCarreras.php">Gestión de Carreras</a></li>
                <br>
                <li><a href="../../App/vistas/estadisticas.php">Estadísticas</a></li>
                <br>
                <li><a href="../../App/usuarios/registro.php">Editar Usuario</a></li>
                <br>
                <li><a href="../../App/usuarios/F_E_reporte.php">Reporte de los libros</a></li>
                <br>
            </ul>
        </aside>
    <div class="container">
        <div class="form-container">
            <form method="post">
                <h1>Editar Usuario</h1>
                <label for="nombre">Nombre:</label>
                <input type="text" name="nombre" id="nombre" value="<?php echo htmlspecialchars($user['nombre']); ?>" required>
                
                <label for="correo">Correo:</label>
                <input type="email" name="correo" id="correo" value="<?php echo htmlspecialchars($user['correo']); ?>" required>
                
                <label for="matricula">Matrícula:</label>
                <input type="text" name="matricula" id="matricula" value="<?php echo htmlspecialchars($user['matricula'] ?? ''); ?>">
                
                <label for="contrasena">Nueva Contraseña (dejar en blanco si no desea cambiarla):</label>
                <input type="password" name="contrasena" id="contrasena">
                
                <label for="estado">Estado:</label>
                <select name="estado" id="estado" required>
                    <option value="activo" <?php echo ($user['estado'] === 'activo') ? 'selected' : ''; ?>>Activo</option>
                    <option value="inactivo" <?php echo ($user['estado'] === 'inactivo') ? 'selected' : ''; ?>>Inactivo</option>
                </select>
                
                <button type="submit">Guardar cambios</button>
                
                <a href="reporte.php">Cancelar</a>
            </form>
        </div>
    </div>
</body>
</html>
<?php
$connection->close();
?>