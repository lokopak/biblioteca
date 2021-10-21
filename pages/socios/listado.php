<?php

// Mostramos el contenido html del head
require_once(__DIR__ . "/../view/head.php");
// Cargamos las funciones para manejar la tabla de socios
require_once(__DIR__ . "/model/db.php");
// Cargamos las funciones para recoger datos desde la Request.
require_once(__DIR__ . "/../conexion/request.php");

// Obtenemos el valor de la página de la url.
$pagina = (int) obtenerDesdeGet("pagina", 1);

// Obtenemos el valor del limite desde la url.
$limite = (int) obtenerDesdeGet("limite", 10);

// Obtenemos el valor del campo desde la url.
$ordenPor = obtenerDesdeGet("ordenPor", "apellidos");

// Obtenemos el valor del orden desde la url.
$orden = obtenerDesdeGet("orden", "ASC");

// Obtenemos el valor del orden desde la url.
$estado = (int) obtenerDesdeGet("estado", 1);

// Obtenemos todos los autores de la tabla.
$resultado = sociosBuscarTodos($pagina, $limite, $ordenPor, $orden, $estado);

// Mostramos el contenido html de la página
require(__DIR__ . "/view/listado.php");


// Mostramos el contenido html del footer.
require_once(__DIR__ . "/../view/footer.php");