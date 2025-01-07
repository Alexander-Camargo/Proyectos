<?php
	session_start();

	// Destruir todas las variables de sesión y la sesión
	session_unset();
	session_destroy();

	// Redirigir al formulario de login
	header("Location: ../index.php");
	exit();
?>