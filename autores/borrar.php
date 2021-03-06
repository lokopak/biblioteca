<?php
require_once(dirname(__FILE__) . "/../view/head.php");

// Cargamos las funciones para recoger datos desde la Request.
require_once(__DIR__ . "/../conexion/request.php");

$idAutor = obtenerDesdeGet('idAutor', null);

// Si no se indica ninguna idAutor, mostramos un error
if (null === $idAutor) {
    agregarError("La petición no es correcta.", "Error");
    // Mostrar no encontrado.    
    require_once(dirname(__FILE__) . "/../view/footer.php");
    return;
}

// Cargamos el archivo necesario para manejar la tabla de autores.
require_once(__DIR__ . "/model/db.php");

$autor = autoresBuscarUno($idAutor);

if (null === $autor) {
    require(__DIR__ . "/../view/no-encontrado.php");
    return;
}

// Realizamos la petición
$resultado = autoresBorrar($autor);

// Si el resultado es correcto, mostramos la página con la información.
if ($resultado) {
    require(__DIR__ . "/view/borrado.php");
} else {
    agregarError("Se ha producido un error y no se ha podido borrar el elemento.", "Error");
}
require_once(dirname(__FILE__) . "/../view/footer.php");