<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservar Libros</title>
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
            padding: 0; /* Eliminar padding extra */
            border: none; /* Eliminar borde */
            background-color: transparent; /* Hacer el fondo del formulario transparente */
        }

        .btn-reservar {
            padding: 8px 12px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
        }

        .btn-reservar:hover {
            background-color: #0056b3;
        }

        /* Paginación */
        .paginacion {
            text-align: center;
            margin-top: 20px;
        }

        .paginacion a {
            padding: 8px 12px;
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
        <main class="content">
            <h2>Catálogo de Libros</h2>
            <section class="catalogo">
                <?php
                require_once '../../App/controladores/CatalogoController.php';
                session_start();

                $controller = new CatalogoController();
                $paginaActual = isset($_GET['pagina']) ? intval($_GET['pagina']) : 1;
                $librosPaginados = $controller->mostrarCatalogoPaginado($paginaActual, 10);

                foreach ($librosPaginados['libros'] as $libro) {
                    echo '<div class="libro-card">';
                    echo '<img src="' . htmlspecialchars($libro['ruta_imagen']) . '" alt="' . htmlspecialchars($libro['titulo']) . '">';
                    echo '<h3>' . htmlspecialchars($libro['titulo']) . '</h3>';
                    echo '<p>Autor: ' . htmlspecialchars($libro['autor']) . '</p>';
                    echo '<p>Disponible: ' . htmlspecialchars($libro['unidades_disponibles']) . '</p>';
                    echo '</div>';
                }
                ?>
            </section>

            <!-- Paginación -->
            <div class="pagination">
                <?php
                $totalPaginas = $librosPaginados['totalPaginas'];
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