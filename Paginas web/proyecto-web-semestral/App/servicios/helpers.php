<?php

    function crearThumbnail($imagenOriginal, $thumbnail) {
        list($ancho, $alto) = getimagesize($imagenOriginal); // Obtiene las dimensiones de la imagen original
        $nuevoAncho = 150; // Ancho del thumbnail
        $nuevoAlto = ($alto / $ancho) * $nuevoAncho; // Calcula el alto proporcional

        // Crea una nueva imagen con las dimensiones reducidas
        $imagenReducida = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
        $origen = imagecreatefromstring(file_get_contents($imagenOriginal)); // Carga la imagen original

        imagecopyresampled($imagenReducida, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto); // Redimensiona

        // Guarda la nueva imagen como archivo JPEG
        imagejpeg($imagenReducida, $thumbnail, 80);

        // Libera memoria
        imagedestroy($imagenReducida);
        imagedestroy($origen);
    }

?>