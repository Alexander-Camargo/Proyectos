<?php

error_reporting(E_ALL);

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
    // Función para exportar libros a CSV
    exportarCSV($connection);
    exit;
}

// Obtener los valores de búsqueda ingresados por el usuario
$searchTitle = isset($_POST['search_title']) ? $_POST['search_title'] : '';
$searchAuthor = isset($_POST['search_author']) ? $_POST['search_author'] : '';

// Comenzar la consulta SQL
$query = "SELECT l.id_libro, l.titulo, l.autor, l.editorial, l.anio, 
                 l.unidades_disponibles, c.nombre_categoria, i.ruta_imagen
          FROM libros l
          LEFT JOIN categorias c ON l.categoria_id = c.id_categoria
          LEFT JOIN imagenes_libros i ON l.id_libro = i.id_libro";

// Agregar condiciones a la consulta si hay búsquedas por título o autor
$conditions = [];
if (!empty($searchTitle)) {
    $conditions[] = "l.titulo LIKE '%" . $connection->real_escape_string($searchTitle) . "%'";
}

if (!empty($searchAuthor)) {
    $conditions[] = "l.autor LIKE '%" . $connection->real_escape_string($searchAuthor) . "%'";
}

if (!empty($conditions)) {
    $query .= " WHERE " . implode(" AND ", $conditions);
}

$result = $connection->query($query);

function exportarCSV($connection) {
    // Establecer los encabezados de la respuesta para la descarga del archivo CSV
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="libros_report.csv"');
    
    // Crear el archivo CSV
    $output = fopen('php://output', 'w');
    
    // Escribir los encabezados del archivo CSV
    fputcsv($output, ['ID Libro', 'Título', 'Autor', 'Editorial', 'Año', 'Unidades Disponibles', 'Categoría', 'Imagen']);
    
    // Escribir los datos de los libros
    $query = "SELECT l.id_libro, l.titulo, l.autor, l.editorial, l.anio, 
                     l.unidades_disponibles, c.nombre_categoria, i.ruta_imagen
              FROM libros l
              LEFT JOIN categorias c ON l.categoria_id = c.id_categoria
              LEFT JOIN imagenes_libros i ON l.id_libro = i.id_libro";
    $result = $connection->query($query);
    
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            fputcsv($output, [
                $row['id_libro'],
                $row['titulo'],
                $row['autor'],
                $row['editorial'],
                $row['anio'],
                $row['unidades_disponibles'],
                $row['nombre_categoria'],
                $row['ruta_imagen'] ?? 'No disponible'
            ]);
        }
    }
    
    fclose($output);
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Libros</title>
    <link rel="stylesheet" href="../../Public/css/styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container_2 {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #333;
        }
        form {
            margin-bottom: 20px;
            box-shadow: none;
        }
        input[type="text"], input[type="email"], select {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .button-group {
            text-align: center;
        }
        button {
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table th, table td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ddd;
        }
        table th {
            background-color: #007bff;
            color: white;
        }
        .button-group a {
            text-decoration: none;
            color: #007bff;
        }
        .button-group a:hover {
            color: #0056b3;
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
    <div class="container_2">

        <!-- Formulario de búsqueda -->
        <div>
            <form method="post">
                <h1>Reporte de Libros</h1>

                <label for="search_title">Buscar por título:</label>
                <input type="text" id="search_title" name="search_title" value="<?php echo htmlspecialchars($searchTitle); ?>">
                
                <label for="search_author">Buscar por autor:</label>
                <input type="text" id="search_author" name="search_author" value="<?php echo htmlspecialchars($searchAuthor); ?>">

                <div class="button-group">
                    <button type="submit">Buscar</button>
                </div>
            </form>
        </div>

        <br>
        <div>
            <table>
                <tr>
                    <th>ID Libro</th>
                    <th>Título</th>
                    <th>Autor</th>
                    <th>Editorial</th>
                    <th>Año</th>
                    <th>Unidades Disponibles</th>
                    <th>Categoría</th>
                    <th>Imagen</th>
                </tr>
                <?php if ($result && $result->num_rows > 0) : ?>
                    <?php while ($row = $result->fetch_assoc()) : ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['id_libro']); ?></td>
                            <td><?php echo htmlspecialchars($row['titulo']); ?></td>
                            <td><?php echo htmlspecialchars($row['autor']); ?></td>
                            <td><?php echo htmlspecialchars($row['editorial']); ?></td>
                            <td><?php echo htmlspecialchars($row['anio']); ?></td>
                            <td><?php echo htmlspecialchars($row['unidades_disponibles']); ?></td>
                            <td><?php echo htmlspecialchars($row['nombre_categoria']); ?></td>
                            <td>
                                <?php if ($row['ruta_imagen']) : ?>
                                    <img src="<?php echo htmlspecialchars($row['ruta_imagen']); ?>" alt="Imagen del libro" width="100">
                                <?php else : ?>
                                    No disponible
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="8">No se encontraron registros.</td>
                    </tr>
                <?php endif; ?>
            </table>
        </div>
        
        <!-- Botón para exportar a CSV -->
        <form method="post">
            <br>
            <button type="submit" name="exportar_csv">Exportar a CSV</button>
        </form>
        
    </div>
</body>
</html>

<?php
// Cerrar la conexión a la base de datos
$connection->close();
?>

