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

    <div id="main-about-general" class="main">
        <div class="opciones-paginas">
            <section class="noticias">
                <h3>Noticias de otras universidades:</h3>
                <div class="noticias-list">
                    <div class="soporte_div">
                        <h4>Rodolfo Campos</h4>
                        <img src="../assets/Imagenes/about/rodolfo.jpg" alt="">
                    </div>
                    <div class="soporte_div">
                        <h4>Adriana Achurra</h4>
                        <img src="../assets/Imagenes/about/adriana.jpg" alt="">
                    </div>
                    <div class="soporte_div">
                        <h4>Alexander Camargo</h4>
                        <img src="../assets/Imagenes/about/alexander.jpg" alt="">
                    </div>
                    <div class="soporte_div">
                        <h4>Victor Arrocha</h4>
                        <img src="../assets/Imagenes/about/victor.jpg" alt="">
                    </div>
                    <div class="soporte_div">
                        <h4>Sebastian Ferrer</h4>
                        <img src="../assets/Imagenes/about/sebas.jpg" alt="">
                    </div>
                </div>
            </section>
        </div>
    </div>

<footer class="footer">
        <div class="footer_columna">
            <h4>MathUP</h4>
            <ul>
                <li><a href="home.jsp?correo=<%= request.getParameter("correo") %>">Inicio</a></li>
                <li><a href="portal_usuario.jsp?correo=<%= request.getParameter("correo") %>">Portal Usuarios</a></li>
                <li><a href="registro_curso.jsp?correo=<%= request.getParameter("correo") %>">Registar Curso</a></li>
                <li><a href="lista_cursos.jsp?correo=<%= request.getParameter("correo") %>">Lista de Cursos</a></li>
                <li><a href="registro_leccion.jsp?correo=<%= request.getParameter("correo") %>">Registar Lección</a></li>
                <li><a href="registro_usuario.jsp?correo=<%= request.getParameter("correo") %>">Registrar Usuario</a></li>
                <li><a href="lista_admins.jsp?correo=<%= request.getParameter("correo") %>">Lista de Administradores</a></li>
                <li><a href="lista_profesores.jsp?correo=<%= request.getParameter("correo") %>">Lista de Profesores</a></li>
                <li><a href="lista_estdiantes.jsp?correo=<%= request.getParameter("correo") %>">Lista de Estudiantes</a></li>
                <li><a href="about.jsp?correo=<%= request.getParameter("correo") %>">Sobre Nosotros</a></li>
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
                <li><a href="../general/home.html">Log Out</a></li>
            </ul>
        </div>
    </footer>
</body>
</html>