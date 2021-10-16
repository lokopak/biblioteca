<?php

// Mostramos el contenido html del head
require_once(__DIR__ . "/../view/head.php");

// Cargamos los datos necesarios para gestionar socios
require_once(__DIR__ . "/model/socio.php");

// Cargamos las funciones para recoger datos desde la Request.
require_once(__DIR__ . "/../conexion/request.php");

$idSocio = obtenerDesdeGet("idSocio", null);

// Si no se proporciona ninguna idSocio, mostramos un error
if (null === $idSocio) {
    agregarError("La petición no es correcta.", "Error");
    // Mostrar no encontrado.    
    require_once(dirname(__FILE__) . "/../view/footer.php");
    return;
}

// Cargamos el archivo necesario para manejar la tabla de socios.
require_once(__DIR__ . "/model/db.php");

// Buscamos el socio para comprobar que existe.
$socio = sociosBuscarUno((int)$idSocio);

// Si no existe el socio... mostramos la página de no encontrado
if (null === $socio) {
    require(__DIR__ . "/../view/no-encontrado.php");
    return;
}


// Mostramos el contenido html de la página
require(__DIR__ . "/view/mostrar.php");

// Mostramos el contenido html del footer.
require_once(__DIR__ . "/../view/footer.php");