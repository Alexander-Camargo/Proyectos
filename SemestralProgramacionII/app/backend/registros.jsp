<%@ page language="java" contentType="text/html; charset=UTF-8" pageEncoding="UTF-8"%>
<%@ page import="java.sql.*" %>
<%@ page import="java.time.*"%>
<%@ page import="java.time.format.*"%>
<%@ page import="java.time.temporal.ChronoUnit"%>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Registro</title>
</head>
<body>

<%
    String usuario = "Admin";
    String contraseña = "12345";

    Connection dbconnect = null;

    try {
        Class.forName("oracle.jdbc.driver.OracleDriver");
        dbconnect = DriverManager.getConnection("jdbc:oracle:thin:@localhost:1521:XE", usuario, contraseña);
        dbconnect.setAutoCommit(false);

        // Obtener parámetros del formulario
        String nombre = request.getParameter("fname");
        String apellido = request.getParameter("lname");
        Date fechaNacimiento = Date.valueOf(request.getParameter("fecha_de_nacimiento"));
        String correo = request.getParameter("Correo");
        String contrasena = request.getParameter("Contraseña");
        int idEsp = Integer.parseInt(request.getParameter("especialidad"));
        int idAdmin = Integer.parseInt(request.getParameter("id_admin"));
        int celular = Integer.parseInt(request.getParameter("Celular"));
        String username = request.getParameter("username");

        
        LocalDate fechaNacimientoLocal = fechaNacimiento.toLocalDate();
        LocalDate fechaActual = LocalDate.now();//extraemos la fecha actual del sistema
        long edad = ChronoUnit.YEARS.between(fechaNacimientoLocal, fechaActual);//con esto calculamos la edad
        
        
        int n = Integer.parseInt(request.getParameter("op_login"));

        if (n==1) {

            // Consulta SQL para obtener el último valor de id_profesor
            String queryLastId = "SELECT MAX(id_profesor) AS last_id FROM Profesores";
            Statement stmt = dbconnect.createStatement();
            ResultSet rs = stmt.executeQuery(queryLastId);
            int id_prof = 0;

            if (rs.next()) {
                id_prof = rs.getInt("last_id") + 1; //sumamos uno para no repetir la PK
            } else {
                id_prof = 1; //si no hay nada lo iniciamos con un 1
            }
            rs.close();
            stmt.close();

            String insertarsql = "INSERT INTO Profesores (id_profesor, nombre_pr, apellido_pr, fecha_de_nacimiento_pr, edad_pr, correo_pr, contrasena_pr, id_esp_fk_pr, id_admin_fk_pr, celular_pr) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            PreparedStatement pstmt = dbconnect.prepareStatement(insertarsql);
            pstmt.setInt(1, id_prof);
            pstmt.setString(2, nombre);
            pstmt.setString(3, apellido);
            pstmt.setDate(4, fechaNacimiento);
            pstmt.setLong(5, edad); // Edad calculada
            pstmt.setString(6, correo);
            pstmt.setString(7, contrasena);
            pstmt.setInt(8, idEsp);
            pstmt.setInt(9, idAdmin);
            pstmt.setInt(10, celular);
            pstmt.executeUpdate();
        } else if (n==2) {
            
            // Consulta SQL para obtener el último valor de id_profesor
            String queryLastId = "SELECT MAX(id_admin) AS last_id FROM Admins";// con esta consulta obtenemos el ultimo valor
            Statement stmt = dbconnect.createStatement();
            ResultSet rs = stmt.executeQuery(queryLastId);
            int id_admin = 0;

            if (rs.next()) {
            	id_admin = rs.getInt("last_id") + 1; //sumamos uno para no repetir la PK
            } else {
            	id_admin = 1; //si no hay nada lo iniciamos con un 1
            }
            rs.close();
            stmt.close();

            String insertarsql = "INSERT INTO Admins (id_admin, nombre_adm, apellido_adm, fecha_de_nacimiento_adm, edad_adm, correo_adm, contrasena_adm, celular_adm) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            PreparedStatement pstmt = dbconnect.prepareStatement(insertarsql);
            pstmt.setInt(1, id_admin);
            pstmt.setString(2, nombre);
            pstmt.setString(3, apellido);
            pstmt.setDate(4, fechaNacimiento);
            pstmt.setLong(5, edad);
            pstmt.setString(6, correo);
            pstmt.setString(7, contrasena);
            pstmt.setInt(8, celular);
            pstmt.executeUpdate();
        } else {
            // Inserción para usuario regular
            // Consulta SQL para obtener el último valor de id_profesor
            String queryLastId = "SELECT MAX(id_usuario_usr) AS last_id FROM Usuarios";// con esta consulta obtenemos el ultimo valor
            Statement stmt = dbconnect.createStatement();
            ResultSet rs = stmt.executeQuery(queryLastId);
            int id_user = 0;

            if (rs.next()) {
            	id_user = rs.getInt("last_id") + 1; //sumamos uno para no repetir la PK
            } else {
            	id_user = 1; //si no hay nada lo iniciamos con un 1
            }
            rs.close();
            stmt.close();

            String insertarsql = "INSERT INTO Usuarios (id_usuario_usr, nombre_usr, apellido_usr, fecha_nacimiento_usr, edad_usr, username, correo_usr, contrasena_usr) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            PreparedStatement pstmt = dbconnect.prepareStatement(insertarsql);
            pstmt.setInt(1, id_user);
            pstmt.setString(2, nombre);
            pstmt.setString(3, apellido);
            pstmt.setDate(4, fechaNacimiento);
            pstmt.setLong(5, edad); // Edad calculada
            pstmt.setString(6, username);
            pstmt.setString(7, correo);
            pstmt.setString(8, contrasena);
            pstmt.executeUpdate();
        }

        dbconnect.commit(); // Confirmar la transacción

        out.println("Registro exitoso.");

    } catch (ClassNotFoundException | SQLException e) {
        out.println("Error: " + e.getMessage());
        if (dbconnect != null) {
            try {
                dbconnect.rollback();
            } catch (SQLException ex) {
                out.println("Error al hacer rollback: " + ex.getMessage());
            }
        }
    } 

%>

</body>
</html>

