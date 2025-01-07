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

     <main class="main-login-general">
        <div class="contenedor-login">
            <form action="/app/backend/registros.jsp" method="post" class="clase-form">
                <h2>Registro de Usuario</h2>
                <div class="icono-seleccion">
                	<div class="icono-seleccion-grupo">
                		<label for="Estudiante">Estudiante</label>
                        <input type="radio" id="Estudiante" name="op_login" value="1" required>
                    </div>
                    <div class="icono-seleccion-grupo">
                    	<label for="Profesor">Profesor</label>
                        <input type="radio" id="Profesor" name="op_login" value="2" required>
                    </div>
                    <div class="icono-seleccion-grupo">
                    	<label for="Administrador">Administrador</label>
                        <input type="radio" id="Administrador" name="op_login" value="3" required>                        
                    </div>
                </div>

                <div class="clase-form">
                    <label for="fname">Nombre:</label>
                    <input class="clase-form-input" type="text" id="fname" name="fname" required><br/><br/>
                    
                    <label for="lname">Apellido:</label>
                    <input class="clase-form-input" type="text" id="lname" name="lname" required><br/><br/>
                    
                    <label for="usernameUs">Nombre de usuario:</label>
                    <input class="clase-form-input" type="text" id="usernameUs" name="usernameUs" required><br/><br/>

                    <label for="Correo">Correo:</label>
                    <input class="clase-form-input" type="email" id="Correo" name="Correo" required><br/><br/>

                    <label for="Contraseña">Contraseña:</label>
                    <input class="clase-form-input" type="password" id="Contraseña" name="Contraseña" required><br/><br/>

                    <label for="Celular">Celular:</label>
                    <input class="clase-form-input" type="tel" id="Celular" name="Celular" required><br/><br/>

                    <label for="id_admin">Administrador:</label>
                    <input class="clase-form-input" type="text" id="id_admin" name="id_admin" required><br/><br/>

                    <label for="fecha_de_nacimiento">Fecha de nacimiento:</label>
                    <input class="clase-form-input" type="date" id="fecha_de_nacimiento" name="fecha_de_nacimiento" value="2024-03-01" min="1924-03-01" max="2004-07-07" required><br/><br/>

                    <label for="especialidad">Especialidad:</label>
                    <select id="especialidad" name="especialidad" required>
                        <option value="1">Matemáticas</option>
                        <option value="2">Física</option>
                        <option value="3">Programación</option>
                    </select><br/><br/>
                </div>

                <div class="button-container">
                    <input class="btn btn-default" type="submit" value="Registrarse">
                </div>
            </form>
        </div>
    </main>

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