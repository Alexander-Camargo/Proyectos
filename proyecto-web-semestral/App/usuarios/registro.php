<?php
session_start();
require_once 'database.php';
require_once 'logs.php';

// Crear la conexión a la base de datos
$connection = new mysqli('localhost', 'Alex_mysql', 'hollow2rojo6', 'bd_examen_ing_web', 3307);
if ($connection->connect_error) {
    die("Conexión fallida: " . $connection->connect_error);
}

$logs = new Logs($connection);

// Verificar si el botón para exportar a CSV fue presionado
if (isset($_POST['exportar_csv'])) {
    exportarCSV($connection);
    exit;
}

// Obtener el valor de búsqueda ingresado por el usuario
$searchName = isset($_POST['search_name']) ? $_POST['search_name'] : '';

// Modificar la consulta para incluir el filtro de búsqueda en la tabla `usuarios`
$query = "SELECT id_usuario, nombre, correo, matricula, estado FROM usuarios";

if (!empty($searchName)) {
    $query .= " WHERE nombre LIKE '%" . $connection->real_escape_string($searchName) . "%' OR correo LIKE '%" . $connection->real_escape_string($searchName) . "%'";
}

$result = $connection->query($query);

// Función para exportar a CSV
function exportarCSV($connection) {
    $query = "SELECT nombre, correo, matricula, estado FROM usuarios";
    $result = $connection->query($query);

    if ($result->num_rows > 0) {
        // Cabecera del archivo CSV
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="usuarios.csv"');

        $output = fopen('php://output', 'w');
        fputcsv($output, ['Nombre', 'Correo', 'Matrícula', 'Estado']);

        // Escribir los datos de los usuarios al archivo CSV
        while ($row = $result->fetch_assoc()) {
            fputcsv($output, $row);
        }
        fclose($output);
    } else {
        echo "No hay registros para exportar.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Usuarios</title>
    <link rel="stylesheet" href="../../Public/css/styles.css">
    <style>
        /* Estilos generales */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #333;
            color: #fff;
            padding: 10px 0;
            text-align: center;
        }

        header h1 {
            margin: 0;
            font-size: 1.5em;
        }

        nav ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        nav ul li {
            display: inline;
            margin: 0 15px;
        }

        nav ul li a {
            color: white;
            text-decoration: none;
            font-weight: bold;
        }

        /* Contenedor principal */
        .container {
            display: flex;
            min-height: 100vh;
        }

        aside {
            background-color: #2c3e50;
            color: white;
            width: 220px;
            padding: 20px;
        }

        aside ul {
            list-style-type: none;
            padding: 0;
        }

        aside ul li {
            margin: 10px 0;
        }

        aside ul li a {
            color: #ecf0f1;
            text-decoration: none;
        }

        aside ul li a:hover {
            text-decoration: underline;
        }

        /* Contenido principal */
        main.content {
            flex: 1;
            padding: 20px;
        }

        main h2 {
            color: #333;
            font-size: 1.8em;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table th, table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        table th {
            background-color: #3498db;
            color: white;
        }

        table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        table tr:hover {
            background-color: #f9f9f9;
        }

        .button-group {
            margin-top: 15px;
        }

        button {
            background-color: #3498db;
            color: white;
            border: none;
            padding: 10px 15px;
            cursor: pointer;
            font-size: 1em;
        }

        button:hover {
            background-color: #2980b9;
        }

        a {
            display: inline-block;
            margin-top: 20px;
            color: #3498db;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        /* Estilo de formulario */
        form {
            box-shadow: none;
            margin-bottom: 20px;
        }

        input[type="text"] {
            padding: 8px;
            width: 200px;
            margin-right: 10px;
            border: 1px solid #ccc;
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
        <main class="content">
            <h2>Reporte de Usuarios</h2>

            <!-- Formulario de búsqueda -->
            <div>
                <form method="post">
                    <label for="search_name">Buscar por nombre o correo:</label>
                    <input type="text" id="search_name" name="search_name" value="<?php echo htmlspecialchars($searchName); ?>">
                    <div class="button-group">
                        <button type="submit">Buscar</button>
                    </div>
                </form>
            </div>

            <div>
                <table>
                    <tr>
                        <th>Nombre</th>
                        <th>Correo</th>
                        <th>Matrícula</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                    <?php if ($result && $result->num_rows > 0) : ?>
                        <?php while ($row = $result->fetch_assoc()) : ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row['nombre']); ?></td>
                                <td><?php echo htmlspecialchars($row['correo']); ?></td>
                                <td><?php echo htmlspecialchars($row['matricula']); ?></td>
                                <td><?php echo htmlspecialchars($row['estado']); ?></td>
                                <td>
                                    <a href="editar_usuario.php?id=<?php echo $row['id_usuario']; ?>">Editar</a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="5">No se encontraron registros.</td>
                        </tr>
                    <?php endif; ?>
                </table>
            </div>

            <!-- Botón para exportar a CSV -->
            <form method="post">
                <button type="submit" name="exportar_csv">Exportar a CSV</button>
            </form>

            <a href="index.php">Regresar a login</a>
        </main>
    </div>
</body>

</html>

<?php
// Cerrar la conexión a la base de datos
$connection->close();
?>