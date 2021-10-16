<?php
// Mostramos el contenido html del head
require_once(__DIR__ . "/../view/head.php");

// Cargamos el código necesario para manejar la tabla de préstamos en la base de datos.
require_once(__DIR__ . "/model/db.php");

// Cargamos las funciones necesarias para gestionar préstamos.
require_once(__DIR__ . "/model/prestamo.php");

// Comprobamos que se haya enviado el número de la página en la url
if (isset($_REQUEST["pagina"])) {
    // Obtenemos el valor de la página de la url.
    $pagina = (int) $_REQUEST["pagina"];
} else {
    // Si no viene en la url, le damos un valor por defecto.
    $pagina = 1;
}

// Comprobamos que se haya enviado el límite de elementos por página en la url
if (isset($_REQUEST["limite"])) {
    // Obtenemos el valor del limite desde la url.
    $limite = (int) $_REQUEST["limite"];
} else {
    // Si no viene en la url, le damos un valor por defecto.
    $limite = 10;
}

// Comprobamos que se haya enviado el campo por el que se orderarán los elementos por página en la url
if (isset($_REQUEST["ordenPor"])) {
    // Obtenemos el valor del campo desde la url.
    $ordenPor = $_REQUEST["ordenPor"];
} else {
    // Si no viene en la url, le damos un valor por defecto.
    $ordenPor = "apellidos";
}

// Comprobamos que se haya enviado el orden de elementos por página en la url
if (isset($_REQUEST["orden"])) {
    // Obtenemos el valor del orden desde la url.
    $orden = $_REQUEST["orden"];
} else {
    // Si no viene en la url, le damos un valor por defecto.
    $orden = "ASC";
}

// Comprobamos que se haya enviado el estado de los elementos en la url
if (isset($_REQUEST["estado"])) {
    // Obtenemos el valor del orden desde la url.
    $estado = (int) $_REQUEST["estado"];
} else {
    // Si no viene en la url, le damos un valor por defecto.
    $estado = null;
}

// Obtenemos todos los autores de la tabla.
$resultado = prestamoBuscarTodos($pagina, $limite, $ordenPor, $orden, $estado);

// Mostramos el contenido html de la página
require(__DIR__ . "/view/listado.php");

// Mostramos el contenido html del footer.
require_once(__DIR__ . "/../view/footer.php");