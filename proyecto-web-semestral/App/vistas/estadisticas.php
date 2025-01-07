<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estadísticas de Reservas</title>
    <link rel="stylesheet" href="../../Public/css/styles.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .canvas-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin: 20px 0;
        }

        canvas {
            max-width: 90%;
            height: auto;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h3 {
            text-align: center;
            font-size: 1.2em;
            margin: 10px 0;
        }
    </style>
</head>

<body>
    <header>
        <nav class="navbar">
            <h1>Sistema de Gestión</h1>
            <ul>
                <li><a href="homeAdmin.php">Inicio</a></li>
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
            <h2>Estadísticas de Reservas</h2>

            <?php
            require_once '../controladores/EstadisticasController.php';

            $controller = new EstadisticasController();

            $librosMasUsados = $controller->librosMasUsadosUltimoMes();
            $fechasMasReservas = $controller->fechasConMasReservasUltimoMes();
            ?>

            <div class="canvas-container">
                <h3>Libros más usados el último mes</h3>
                <canvas id="librosMasUsadosChart"></canvas>
            </div>

            <div class="canvas-container">
                <h3>Fechas con más reservas el último mes</h3>
                <canvas id="fechasMasReservasChart"></canvas>
            </div>
        </main>
    </div>

    <script>
        // Gráfica de Libros Más Usados
        const librosMasUsadosData = {
            labels: <?= json_encode(array_column($librosMasUsados, 'titulo')) ?>,
            datasets: [{
                label: 'Reservas',
                data: <?= json_encode(array_column($librosMasUsados, 'total_reservas')) ?>,
                backgroundColor: 'rgba(54, 162, 235, 0.5)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        };
        const librosMasUsadosConfig = {
            type: 'bar',
            data: librosMasUsadosData,
            options: { responsive: true }
        };
        new Chart(document.getElementById('librosMasUsadosChart'), librosMasUsadosConfig);

        // Gráfica de Fechas con Más Reservas
        const fechasMasReservasData = {
            labels: <?= json_encode(array_column($fechasMasReservas, 'fecha')) ?>,
            datasets: [{
                label: 'Reservas',
                data: <?= json_encode(array_column($fechasMasReservas, 'total_reservas')) ?>,
                backgroundColor: 'rgba(255, 99, 132, 0.5)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1
            }]
        };
        const fechasMasReservasConfig = {
            type: 'line',
            data: fechasMasReservasData,
            options: { responsive: true }
        };
        new Chart(document.getElementById('fechasMasReservasChart'), fechasMasReservasConfig);
    </script>
</body>

</html>
