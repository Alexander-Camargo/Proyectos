<!DOCTYPE html>

<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio - Usuario</title>
    <link rel="stylesheet" href="../../Public/css/styles.css">
</head>

<body>
    <header>
        <nav class="navbar">
            <h1>Sistema de Gestión</h1>
            <ul>
                <li><a href="homeUsuario.php">Inicio</a></li>
                <li><a href="perfilUsuario.php">Perfil</a></li>
                <li><a href="logout.php">Cerrar Sesión</a></li>
            </ul>
        </nav>
    </header>
    <div class="container">
        <aside class="sidebar">
            <ul>
                <li><a href="moduloReservas.php">Catalogo de Libros</a></li>
                <li><a href="moduloLibros.php">Gestión de mis libros</a></li>
            </ul>
        </aside>
        <main class="content">
            <?php
				session_start();
				if (isset($_SESSION['nombre'])) {
					echo "<h2>Bienvenido, " . htmlspecialchars($_SESSION['nombre']) . "!</h2>";
				} else {
					echo "<h2>Bienvenido Usuario</h2>";
				}
            ?>
            <p>Utiliza el menú a la izquierda para navegar por las opciones disponibles.</p>
        </main>
    </div>
</body>

</html>