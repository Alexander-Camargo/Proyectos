<%@ page language="java" contentType="text/html; charset=UTF-8" pageEncoding="UTF-8"%>
<%@ page import="java.sql.*" %>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Login</title>
</head>
<body>
    <% 
        String usuario = "Admin";
        String contrasena = "12345";
        
        String correo = request.getParameter("Correo");
        String con = request.getParameter("Contraseña");
        String n = request.getParameter("op_login");
        
        PreparedStatement preparado = null;
        ResultSet resultados = null;
        String msg = "";

        try {
            Class.forName("oracle.jdbc.driver.OracleDriver");
            Connection dbconnect = DriverManager.getConnection("jdbc:oracle:thin:@localhost:1521:XE", usuario, contrasena);
            Statement dbstatement = dbconnect.createStatement();
            
            //consultas de la base de datos distintas para cada perfil
            //"preparador" es una varible para cargar la consulta y verificar el usuario
            if("1".equals(n)){
                preparado = dbconnect.prepareStatement("SELECT * FROM Usuarios WHERE correo_usr=? AND contrasena_usr=?");
            } else if("2".equals(n)){
                preparado = dbconnect.prepareStatement("SELECT * FROM Profesores WHERE correo_pr=? AND contrasena_pr=?");
            } else {
                preparado = dbconnect.prepareStatement("SELECT * FROM Admins WHERE correo_adm=? AND contrasena_adm=?");
            }

            preparado.setString(1, correo);
            preparado.setString(2, con);
            resultados = preparado.executeQuery();//confirma el perfil

            if(resultados.next()) {
                
                if("1".equals(n)){
                    response.sendRedirect("../estudiante/home.jsp?correo=" + correo);
                } else if("2".equals(n)){
                    response.sendRedirect("../profesor/home.jsp?correo=" + correo);
                } else {
                    response.sendRedirect("../admin/home.jsp?correo=" + correo);
                }
            } else {
                msg = "<h1 style='color: red;'>****ERROR*** <br> USUARIO INCORRECTO</h1>";
            }
        } catch (Exception e) {
            msg = "<h1 style='color: red;'>Error en la conexión o consulta SQL</h1>";
            e.printStackTrace();
        }
    %>
    
    <%= msg %>
</body>
</html>
