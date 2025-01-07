<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Public/css/styles.css">
    <title>Registro de Usuario</title>
</head>

<body class="login">
    <h1>Registrar Usuario</h1>
    <form method="post">
        <label for="nombre">Nombre:</label>
        <input class="login" type="text" name="nombre" id="nombre" required>
        <br>
        <label for="correo">Correo:</label>
        <input class="login" type="email" name="correo" id="correo" required>
        <br>
        <label for="contrasena">Contraseña:</label>
        <input class="login" type="password" name="contrasena" id="contrasena" required>
        <br>
        <label for="matricula">Matrícula:</label>
        <input class="login" type="text" name="matricula" id="matricula" required>
        <br>

        <label for="id_carrera">Carrera:</label>
        <select class="login" name="id_carrera" id="id_carrera" required>
            <option value="">Seleccione una carrera</option>
            <?php foreach ($carreras as $carrera): ?>
                <option value="<?= $carrera['id_carrera'] ?>"><?= $carrera['nombre_carrera'] ?></option>
            <?php endforeach; ?>
        </select>
        <br>
        
        <input class="subir" type="submit" value="Registrar">
    </form>

    <!-- Enlace para redirigir al login -->
    <p>¿Ya tienes una cuenta? <a href="index.php">Inicia sesión aquí</a></p>
</body>

</html>