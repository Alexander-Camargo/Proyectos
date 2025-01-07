<!-- vistas/login.php -->
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Public/css/styles.css">
    <title>Login</title>
</head>

<body class="login">
    <h1>Inicio de Sesión</h1>
    <form method="post" action="index.php">
        <label for="correo">Correo:</label>
        <input class="login" type="email" name="correo" id="correo" required>
        <br>
        <label for="contrasena">Contraseña:</label>
        <input class="login" type="password" name="contrasena" id="contrasena" required>
        <br>
        <input class="subir" type="submit" value="Iniciar Sesión">
    </form>

    <!-- Enlace para registrar un nuevo usuario -->
    <p>¿No tienes una cuenta?
        <a href="index.php?registrar=1">Registrar Usuario</a>
    </p>
</body>

</html>