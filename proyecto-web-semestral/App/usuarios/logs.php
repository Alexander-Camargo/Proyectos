<?php

class Logs {
    private $db;

    public function __construct($connection) {
        $this->db = $connection;
    }

    // Método para guardar el log en la base de datos
    public function guardarLog($correo, $tipoAccion) {
        $stmt = $this->db->prepare("SELECT nombre FROM users WHERE correo = ?");
        $stmt->bind_param("s", $correo);
        $stmt->execute();
        $stmt->bind_result($nombre);
        $stmt->fetch();
        $stmt->close();

        if ($nombre) {
            $tiempoIngreso = date('Y-m-d H:i:s');
            $stmt = $this->db->prepare("INSERT INTO login_logs (nombre, correo, tiempo_ingreso, tipo_accion) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $nombre, $correo, $tiempoIngreso, $tipoAccion);
            $stmt->execute();
            $stmt->close();
        } else {
            echo "<p style='color:red;'>Usuario no encontrado.</p>";
        }
    }

    // Método para generar y descargar el archivo CSV
    public function generarCSV() {
        // Establecer el nombre del archivo
        $filename = "reporte_logs.csv";
        
        // Abrir el archivo para escritura
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        $output = fopen('php://output', 'w');

        // Escribir los encabezados
        fputcsv($output, ['Nombre', 'Correo', 'Tiempo de Ingreso', 'Tipo de Acción']);

        // Obtener datos de logs
        $stmt = $this->db->prepare("SELECT nombre, correo, tiempo_ingreso, tipo_accion FROM login_logs");
        $stmt->execute();
        $result = $stmt->get_result();

        // Rellenar el archivo con los datos de la base de datos
        while ($row = $result->fetch_assoc()) {
            fputcsv($output, $row);
        }

        fclose($output);
        exit();
    }

        // Método para generar y descargar el archivo CSV
        public function generarCSV_USR() {
            // Establecer el nombre del archivo
            $filename = "reporte_usr_admins.csv";
            
            // Abrir el archivo para escritura
            header('Content-Type: text/csv');
            header('Content-Disposition: attachment; filename="' . $filename . '"');
            $output = fopen('php://output', 'w');
    
            // Escribir los encabezados
            fputcsv($output, ['id_user', 'Nombre', 'apellido', 'cedula', 'Correo']);
    
            // Obtener datos de logs
            $stmt = $this->db->prepare("SELECT id_user, nombre, apellido, cedula, correo FROM users");
            $stmt->execute();
            $result = $stmt->get_result();
    
            // Rellenar el archivo con los datos de la base de datos
            while ($row = $result->fetch_assoc()) {
                fputcsv($output, $row);
            }
    
            fclose($output);
            exit();
        }

    public function generarCSV_FE() {
        // Establecer el nombre del archivo
        $filename = "reporte_fe.csv";
        
        // Abrir el archivo para escritura
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        $output = fopen('php://output', 'w');
    
        // Escribir los encabezados
        fputcsv($output, ['id_inst', 'Nombre', 'apellido', 'edad', 'correo', 'telefono', 'consultas', 'sex', 'nacionalidad', 'pais']);
    
        // Obtener datos de logs
        $stmt = $this->db->prepare("SELECT i.id_inst, i.nombre, i.apellido, i.edad, i.correo, i.telefono, 
            i.consultas, i.sex, 
            np.nacionalidad AS nombre_nacionalidad, p.pais AS nombre_pais
            FROM datos_del_inscriptor i
            LEFT JOIN datos_de_area_interes ai ON i.id_inst = ai.id_inscriptor
            LEFT JOIN datos_de_pais p ON p.id_pais_nacionalidad = i.id_pais
            LEFT JOIN datos_de_pais np ON np.id_pais_nacionalidad = i.id_nacionalidad");
        $stmt->execute();
        $result = $stmt->get_result();
    
        // Rellenar el archivo con los datos de la base de datos
        while ($row = $result->fetch_assoc()) {
            fputcsv($output, [
                $row['id_inst'],
                $row['nombre'],
                $row['apellido'],
                $row['edad'],
                $row['correo'],
                $row['telefono'],
                $row['consultas'],
                $row['sex'],
                $row['nombre_nacionalidad'],
                $row['nombre_pais']
            ]);
        }
    
        fclose($output);
        exit();
    }   
}

?>
