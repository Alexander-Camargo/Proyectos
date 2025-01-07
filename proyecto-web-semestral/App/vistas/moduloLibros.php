<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Mis Libros</title>
    <link rel="stylesheet" href="../../Public/css/styles.css">
    <style>
        .catalogo {
            display: flex;
            flex-wrap: wrap;
            gap: 16px;
        }

        .libro-card {
            border: 1px solid #ddd;
            padding: 10px;
            margin: 10px;
            width: 200px;
            text-align: center;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background-color: #fff;
        }

        .libro-card img {
            max-width: 100%;
            height: auto;
            border-radius: 4px;
            margin-bottom: 8px;
        }

        .libro-card h3 {
            font-size: 16px;
            margin: 5px 0;
        }

        .libro-card p {
            font-size: 14px;
            margin: 5px 0;
        }

        /* Ajustes para el formulario y el botón */
        .libro-card form {
            margin-top: 10px; /* Separar formulario del contenido del libro */
            display: flex;
            justify-content: center; /* Centrar el botón */
			box-shadow: none;
            padding: 0; /* Eliminar padding extra */
            border: none; /* Eliminar borde */
            background-color: transparent; /* Hacer el fondo del formulario transparente */
        }


        .btn-devolver {
            margin-top: 8px;
            padding: 8px 12px;
            background-color: #dc3545;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .btn-devolver:hover {
            background-color: #c82333;
        }

        /* Paginación */
        .paginacion {
			padding-bottom: 40px;
            margin-top: 20px;
            display: flex;
            justify-content: center;
            gap: 10px;
        }

        .paginacion a {
            padding: 10px 12px;
            margin: 0 5px;
            text-decoration: none;
            background-color: #007BFF;
            color: white;
            border-radius: 4px;
        }

        .paginacion a:hover {
            background-color: #0056b3;
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
            <h2>Mis Libros Reservados</h2>
            <section class="catalogo">
                <?php
                require_once '../../App/controladores/ReservasController.php';
                session_start();

                if (!isset($_SESSION['id_usuario'])) {
                    echo "<p style='color: red;'>Debes iniciar sesión para ver esta página.</p>";
                    exit();
                }

                $controller = new ReservasController();
                $idUsuario = $_SESSION['id_usuario'];
                $paginaActual = isset($_GET['pagina']) ? intval($_GET['pagina']) : 1;

                $reservasPaginadas = $controller->obtenerReservasUsuarioPaginadas($idUsuario, $paginaActual, 10);

                foreach ($reservasPaginadas['reservas'] as $libro) {
                    echo '<div class="libro-card">';
                    echo '<img src="' . htmlspecialchars($libro['ruta_imagen']) . '" alt="' . htmlspecialchars($libro['titulo']) . '">';
                    echo '<h3>' . htmlspecialchars($libro['titulo']) . '</h3>';
                    echo '<p>Autor: ' . htmlspecialchars($libro['autor']) . '</p>';
                    echo '<p>Cantidad reservada: ' . htmlspecialchars($libro['cantidad_reservada']) . '</p>';
                    echo '<form action="../../App/controladores/ReservasController.php" method="POST">';
                    echo '<input type="hidden" name="id_reserva" value="' . htmlspecialchars($libro['id_reserva']) . '">';
                    echo '<button type="submit" name="devolver" class="btn-devolver">Devolver</button>';
                    echo '</form>';
                    echo '</div>';
                }
                ?>
            </section>

            <!-- Paginación -->
            <div class="paginacion">
                <?php
                $totalPaginas = $reservasPaginadas['totalPaginas'];
                for ($i = 1; $i <= $totalPaginas; $i++) {
                    $activeClass = $i === $paginaActual ? 'active' : '';
                    echo '<a href="?pagina=' . $i . '" class="' . $activeClass . '">' . $i . '</a>';
                }
                ?>
            </div>
        </main>
    </div>
</body>

</html>
