<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Carreras</title>
    <link rel="stylesheet" href="../../Public/css/styles.css">
    <script>
        function toggleView(view) {
            const list = document.getElementById('listaCarreras');
            const form = document.getElementById('formularioCarreras');
            if (view === 'form') {
                list.style.display = 'none';
                form.style.display = 'block';
            } else {
                list.style.display = 'block';
                form.style.display = 'none';
            }
        }
    </script>
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
            <h2>Gestión de Carreras</h2>

            <!-- Lista de carreras -->
            <div id="listaCarreras">
                <table class="tabla-carreras">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Código</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        require_once '../../App/controladores/CarreraController.php';
                        $controller = new CarreraController();
                        $carreras = $controller->obtenerCarreras();

                        foreach ($carreras as $carrera) {
                            echo "<tr>
                                <td>{$carrera['id_carrera']}</td>
                                <td>{$carrera['nombre_carrera']}</td>
                                <td>{$carrera['codigo_carrera']}</td>
                            </tr>";
                        }
                        ?>
                    </tbody>
                </table>
                <br><br>
                <button class="boton-carreras" onclick="toggleView('form')">Agregar Nueva Carrera</button>
            </div>

            <!-- Formulario de nueva carrera -->
            <div class="registrar" id="formularioCarreras" style="display: none;">
                <form class="form-carreras" action="../../App/controladores/CarreraController.php" method="POST">
                    <label class="form-carreras-label" for="nombre">Nombre de la Carrera:</label>
                    <input class="form-carreras-input" type="text" id="nombre" name="nombre" required>

                    <label class="form-carreras-label" for="codigo">Código de la Carrera:</label>
                    <input class="form-carreras-input" type="text" id="codigo" name="codigo" required>

                    <input class="form-carreras-submit" type="submit" name="agregarCarrera" value="Agregar Carrera">
                </form>
                <br><br>
                <button class="boton-carreras" onclick="toggleView('list')">Volver a la Lista</button>
            </div>
        </main>
    </div>
</body>

</html>