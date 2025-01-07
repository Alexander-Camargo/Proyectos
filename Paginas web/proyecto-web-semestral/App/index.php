<?php
// index.php

require_once 'autoload.php';  // Incluye el autoload.php al principio

// Verificar si el usuario quiere registrarse
if (isset($_GET['registrar']) && $_GET['registrar'] == 1) {
    $usuariosController = new UsuariosController();
    $usuariosController->mostrarFormularioRegistro();
    $usuariosController->registrar();
} else if (isset($_GET['agregar_libro']) && $_GET['agregar_libro'] == 1) {
    // Si se quiere agregar un libro, se llama al controlador de libros
    $librosController = new LibrosController();
    $librosController->agregarLibro();  // Esto se encarga de cargar las categorías
} else {
    // Por defecto, mostrar el login
    $loginController = new LoginController();
    $loginController->login();
    $loginController->close();
}
?>
