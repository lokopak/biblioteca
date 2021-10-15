<?php
require_once(__DIR__ . '/../view/head.php');
// Cargamos las funciones necesarias para poder interactuar con la tabla de libros de la base de datos.
require_once(__DIR__ . '/model/db.php');
// Cargamos las funciones necesarias para poder interactuar con la tabla de autores de la base de datos.
require_once(__DIR__ . "/../autores/model/db.php");
// Cargamos los datos necesarios gestionar los libros.
require_once(__DIR__ . "/model/libro.php");
// Cargamos las funciones para recoger datos desde la Petición del navegador (Request).
require_once(__DIR__ . "/../conexion/request.php");

// Buscamos el listado de autores
$autores = autoresBuscarTodos();

// Si se ha recibido la petición mediante el form, ejecutamos la creación del nuevo libro.
if (esPOST()) {

    $autores = obtenerDesdePost("autores", []);

    require(__DIR__ . "/view/creado.php");
} else {
    // En caso contrario, simplemente mostramos el form.
    require(__DIR__ . "/view/crear.php");
}
require_once(__DIR__ . '/../view/footer.php');