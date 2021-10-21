<?php
require_once(dirname(__FILE__) . "/../view/head.php");

// Cargamos las funciones para recoger datos desde la Request.
require_once(__DIR__ . "/../conexion/request.php");

$idSocio = obtenerDesdeGet('idSocio', null);

// Si no se indica ninguna idSocio, mostramos un error
if (null === $idSocio) {
    agregarError("La petición no es correcta.", "Error");
    // Mostrar no encontrado.    
    require_once(dirname(__FILE__) . "/../view/footer.php");
    return;
}

// Cargamos el archivo necesario para manejar la tabla de socioes.
require_once(__DIR__ . "/model/db.php");

$socio = sociosBuscarUno($idSocio);

if (null === $socio) {
    require(__DIR__ . "/../view/no-encontrado.php");
    return;
}

// Realizamos la petición
$resultado = sociosBorrar($socio);

// Si el resultado es correcto, mostramos la página con la información.
if ($resultado) {
    require(__DIR__ . "/view/borrado.php");
} else {
    agregarError("Se ha producido un error y no se ha podido borrar el elemento.", "Error");
}
require_once(dirname(__FILE__) . "/../view/footer.php");