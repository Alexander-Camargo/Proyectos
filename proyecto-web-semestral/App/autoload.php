<?php
// autoload.php

//echo "Cargando autoload.php...<br>";  // Mensaje de depuración para verificar que se carga el archivo

require_once 'servicios/helpers.php';

function autoload($className) {
    //echo "Buscando la clase: $className<br>";  // Agrega este mensaje de depuración

    // Buscar la clase en el directorio de modelos
    $modelPath = 'modelos/' . $className . '.php';
    if (file_exists($modelPath)) {
        //echo "Cargando la clase desde: $modelPath<br>";
        require_once $modelPath;
        return;
    }

    // Buscar la clase en el directorio de controladores
    $controllerPath = 'controladores/' . $className . '.php';
    if (file_exists($controllerPath)) {
        //echo "Cargando la clase desde: $controllerPath<br>";
        require_once $controllerPath;
        return;
    }

    // Si no se encuentra la clase, muestra un mensaje de error
    echo "Error: No se encontró la clase '$className'.<br>";
}

spl_autoload_register('autoload');
?>
