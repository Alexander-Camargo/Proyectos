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
    <title>MathUP</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body class="body">
    <header>
        <a class="logo" href="home.jsp?correo=<%= request.getParameter("correo") %>"><img src="../assets/Imagenes/MathUP.png" alt="logo"></a>
        <div class="social-icon">
            <a href="https://www.google.com/" target="_blank"><i class="fa fa-search"></i></a>
            <a href="https://www.instagram.com/math_up0/" target="_blank"><i class="fa fa-instagram"></i></a>
            <a href="https://www.facebook.com/profile.php?id=61561506939201" target="_blank"><i class="fa fa-facebook"></i></a>
            <a href="https://x.com/MathUP0" target="_blank"><i class="fa fa-twitter"></i></a>
        </div>
        <!-- <a class="btn btn-default" href="#">Iniciar Sesión</a> -->
        <a class="btn-icon" href="#"><i class="fa fa-user"></i></a>
    </header>

    <div class="navbar">
        <a class="navbar-opcion" href="home.jsp?correo=<%= request.getParameter("correo") %>">Inicio</a>
        <div class="dropdown">
            <button class="navbar-opcion dropdwonbtn" href="#"> Usuarios <i class="fa fa-caret-down"></i></button>
            <div class="dropdown-content">
                <a href="lista_admins.jsp?correo=<%= request.getParameter("correo") %>">Lista de Administradores</a>
                <a href="lista_profesores.jsp?correo=<%= request.getParameter("correo") %>">Lista de Profesores</a>
                <a href="lista_estdiantes.jsp?correo=<%= request.getParameter("correo") %>">Lista de Estudiantes</a>
                <a href="registro_usuario.jsp?correo=<%= request.getParameter("correo") %>">Registrar Usuario</a>
            </div>
        </div>
        <div class="dropdown">
            <button class="navbar-opcion dropdwonbtn" href="#"> Cursos <i class="fa fa-caret-down"></i></button>
            <div class="navbar-opcion dropdown-content">
                <a href="lista_cursos.jsp?correo=<%= request.getParameter("correo") %>">Lista de Cursos</a>
                <a href="lista_profesor_curso.jsp?correo=<%= request.getParameter("correo") %>">Lista de Cursos por Profesor</a>
                <a href="lista_estudiantes_curso.jsp?correo=<%= request.getParameter("correo") %>">Lista de Cursos por Estudiante</a>
            </div>
        </div>
        <a class="navbar-opcion" href="about.jsp?correo=<%= request.getParameter("correo") %>">Sobre Nosotros</a>
    </div>
     <!-- Fin Navbar -->

<div id="main-home-general" class="main">
    <main class="main-lista-profesores">
        <br><h1>Lista por curos de Estudiantes Registrados:</h1><br><br>
                <table border="1">
                <tr>
                    <th>ID Curso</th>
                    <th>Nombre del curso</th>
                    <th>ID Estudiante</th>
                    <th>Nombre del Estudiante</th>
                    <th>Apellido del Estudiante</th>
                    <th>Ver perfil del Estudiante</th>
                </tr>
                <% 
                    String usuario = "Admin";
                    String contrasena = "12345";
                    
                    try {
                        Class.forName("oracle.jdbc.driver.OracleDriver");
                        Connection dbconnect = DriverManager.getConnection("jdbc:oracle:thin:@localhost:1521:XE", usuario, contrasena);
                        Statement dbstatement = dbconnect.createStatement();
                        
                        String mostrarsql = "SELECT c.id_curso, c.nombre_cur, u.id_usuario_usr, u.nombre_usr, u.apellido_usr " +
                                            "FROM Usuarios u " +
                                            "JOIN Usuarios_curso uc ON u.id_usuario_usr = uc.id_usuario_fk_uc " +
                                            "JOIN Cursos c ON uc.id_curso_fk_uc = c.id_curso";
                        ResultSet rs = dbstatement.executeQuery(mostrarsql);
                        boolean hayDatos = false;

                        while (rs.next()) {
                            hayDatos = true;
                %>      
                            <tr>
                                <td><%= rs.getInt("id_curso") %></td>
                                <td><%= rs.getString("nombre_cur") %></td>
                                <td><%= rs.getInt("id_usuario_usr") %></td>
                                <td><%= rs.getString("nombre_usr") %></td>
                                <td><%= rs.getString("apellido_usr") %></td>
                                <td><a href="ver_perfil_est.jsp?id_usuario_usr=<%= rs.getInt("id_usuario_usr") %>" target="_parent">Perfil</a></td>
                            </tr>
                <% 
                        }

                        if (!hayDatos) {
                            out.println("No se encontraron registros en la tabla Usuarios<br>");
                        }

                        rs.close();
                        dbstatement.close();
                        dbconnect.close();
                        
                    } catch (Exception e) {
                        out.println("Error en la conexión o consulta: " + e.getMessage());
                    }
                %>
            </table>
    </main>
</div>
    
<footer class="footer">
        <div class="footer_columna">
            <h4>MathUP</h4>
            <ul>
                <li class="home"><a href="home.jsp?correo=<%= request.getParameter("correo") %>">Inicio</a></li>
                <li><a href="portal_usuario.jsp?correo=<%= request.getParameter("correo") %>">Portal Usuarios</a></li>
                <li><a href="lista_cursos.jsp?correo=<%= request.getParameter("correo") %>">Lista de Cursos</a></li>
                <li><a href="about.jsp?correo=<%= request.getParameter("correo") %>">Sobre Nosotros</a></li>
            </ul>
        </div>
        <div class="footer_columna">
            <h4>Derechos Reservados</h4>
            <p>Este sitio web y su contenido son propiedad de MathUP. Está prohibida cualquier reproducción total o parcial, distribución, comunicación pública o transformación de cualquier contenido de este sitio sin la autorización previa y por escrito de MathUP. Todas las marcas comerciales y logotipos son propiedad de sus respectivos dueños.</p> 

            <p>Si tienes alguna pregunta o comentario sobre nuestros términos de uso, por favor contacta a nuestro equipo de soporte a través del correo electrónico: <a href="mailto:soporte@mathup.com">soporte@mathup.com</a>.</p>        </div>
        <div class="footer_columna">
            <h4>Perfil</h4>
            <ul>
                <li><a href="#">Gestionar Perfil</a></li>
                <li><a href="../general/home.html">Log Out</a></li>
            </ul>
        </div>
    </footer>
</body>
</html>