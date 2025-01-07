<%@ page language="java" contentType="text/html; charset=UTF-8" pageEncoding="UTF-8"%>
<%@ page import="java.sql.*" %>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="shortcut icon" href="../assets/Imagenes/Logo.png">
    <title>MathUP - Lista de Cursos</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body class="body">
    <header>
        <a class="logo" href="../estudiante/home.jsp?correo=<%= request.getParameter("correo") %>"><img src="../assets/Imagenes/MathUP.png" alt="logo"></a>
        <div class="social-icon">
            <a href="https://www.google.com/" target="_blank"><i class="fa fa-search"></i></a>
            <a href="https://www.instagram.com/math_up0/" target="_blank"><i class="fa fa-instagram"></i></a>
            <a href="https://www.facebook.com/profile.php?id=61561506939201" target="_blank"><i class="fa fa-facebook"></i></a>
            <a href="https://x.com/MathUP0" target="_blank"><i class="fa fa-twitter"></i></a>
        </div>
        <a class="btn-icon" href="#"><i class="fa fa-user"></i></a>
    </header>

    <div class="navbar">
        <a class="navbar-opcion" href="home.jsp?correo=<%= request.getParameter("correo") %>">Inicio</a>
        <div class="dropdown">
            <button class="navbar-opcion dropdwonbtn" href="#"> Cursos <i class="fa fa-caret-down"></i></button>
            <div class="navbar-opcion dropdown-content">
                <a href="lista_cursos.jsp?correo=<%= request.getParameter("correo") %>">Lista de Cursos</a>
                <a href="registro_curso.jsp?correo=<%= request.getParameter("correo") %>">Registro de Cursos</a>
                <a href="registro_leccion.jsp?correo=<%= request.getParameter("correo") %>">Registrar Lección</a>
            </div>
        </div>
        <a class="navbar-opcion" href="../estudiante/about.jsp?correo=<%= request.getParameter("correo") %>">Sobre Nosotros</a>
    </div> <!-- Fin Navbar -->
    
	<div id="main-home-general" class="main">
    <h1>Perfil del Curso</h1>
    
    <% 
        // Obtener los parámetros de la URL
        String idcurso = request.getParameter("id_curso");

        if (idcurso != null) {
            try {
                // Convertir idcurso a un entero
                int idcursoInt = Integer.parseInt(idcurso);
                
                String usuario = "Admin";
                String contrasena = "12345";
                String correo = request.getParameter("correo");

                Class.forName("oracle.jdbc.driver.OracleDriver");
                Connection dbconnect = DriverManager.getConnection("jdbc:oracle:thin:@localhost:1521:XE", usuario, contrasena);
                
                String sql = "SELECT * FROM Cursos WHERE id_curso = ?";
                PreparedStatement pstmt = dbconnect.prepareStatement(sql);
                pstmt.setInt(1, idcursoInt);
                ResultSet rs = pstmt.executeQuery();
                
                String sql2 = "SELECT P.nombre_pr, P.apellido_pr FROM Cursos_profesores CP JOIN Profesores P ON CP.id_profesor_fk_lp = P.id_profesor WHERE CP.id_curso_fk_lp = ?";
                PreparedStatement pstmt2 = dbconnect.prepareStatement(sql2);
                pstmt2.setInt(1, idcursoInt);
                ResultSet rs2 = pstmt2.executeQuery();

                if (rs.next()) {
    %>
                    <h1>ID Curso: <%=rs.getString("id_curso") %><br></h1>
                    <h1>Nombre: <%=rs.getString("nombre_cur") %><br></h1>
                    <h1>Descripcion: <%=rs.getString("descripcion_cur") %><br></h1>
                    <h1>Duracion: <%=rs.getString("duracion_cur") %><br></h1>
                    <h1>Dificultad: <%=rs.getString("dificultad_cur") %><br></h1>   
                    <h1>Profesor: 
                    <% 
                        if (rs2.next()) { 
                            String nombreProfesor = rs2.getString("nombre_pr");
                            String apellidoProfesor = rs2.getString("apellido_pr");
                    %>
                            <%= nombreProfesor + " " + apellidoProfesor %><br>
                    <% 
                        } else { 
                    %>
                            No hay profesor asignado<br>
                    <% 
                        } 
                    %>
                    </h1>
					
                    <h2>Lecciones</h2>
                    <table border="1">
                        <tr>
                            <th>ID Leccion</th>
                            <th>Nombre</th>
                            <th>Descripcion</th>
                        </tr>
                    <%
                        String mostrarsql2 = "SELECT * FROM Lecciones WHERE id_curso_fk_lec = ?";
                        PreparedStatement pstmt3 = dbconnect.prepareStatement(mostrarsql2);
                        pstmt3.setInt(1, idcursoInt);
                        ResultSet rs3 = pstmt3.executeQuery();
                        boolean hayDatos = false;
                        
                        while (rs3.next()) {
                            hayDatos = true;
                    %>
                        <tr>
                            <td><%= rs3.getInt("id_leccion") %></td>
                            <td><%= rs3.getString("nombre_lec") %></td>
                            <td><%= rs3.getString("contenido_lec") %></td>
                        </tr>
                    <% 
                        }
                        if (!hayDatos) {
                    %>
                        <tr>
                            <td colspan="3">No se encontraron registros en la tabla Lecciones</td>
                        </tr>
                    <%
                        }
                        rs3.close();
                        pstmt3.close();
                    %>
                    </table>
    <% 
                } else {
                    out.println("No se encontró el curso con ID: " + idcurso + "<br>");
                }

                rs.close();
                rs2.close();
                pstmt.close();
                pstmt2.close();
                dbconnect.close();
            } catch (Exception e) {
                out.println("Error en la conexión o consulta: " + e.getMessage());
            }
        } else {
            out.println("Parámetros no válidos.<br>");
        }
    %>
</div>

<footer class="footer">
        <div class="footer_columna">
            <h4>MathUP</h4>
            <ul>
                <li class="home"><a href="home.jsp?correo=<%= request.getParameter("correo") %>">Inicio</a></li>
                <li class="home"><a href="cursos.jsp?correo=<%= request.getParameter("correo") %>">Listado de Cursos</a></li>
                <li class="about"><a href="about.jsp?correo=<%= request.getParameter("correo") %>">Sobre Nosotros</a></li>
            </ul>
        </div>
        <div class="footer_columna">
            <h4>Derechos Reservados</h4>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Minus esse magnam quis mollitia temporibus blanditiis, quia aliquid rerum sint exercitationem reiciendis nisi placeat itaque fuga dignissimos ipsam accusantium quasi officiis.</p>
        </div>
        <div class="footer_columna">
            <h4>Perfil</h4>
            <ul>
                <li><a href="#">Gestionar Perfil</a></li>
                <li><a href="../general/login.html">Log Out</a></li>
            </ul>
        </div>
    </footer>
</body>
</html>
