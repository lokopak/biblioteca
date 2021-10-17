<?php
// Mostramos el contenido html del head
require_once(__DIR__ . "/../view/head.php");
// Cargamos el archivo necesario para manejar la tabla de autores.
require_once(__DIR__ . "/model/db.php");
// Cargamos las funciones para recoger datos desde la Request.
require_once(__DIR__ . "/../conexion/request.php");
// Cargamos las funciones y constantes relativas a un libro.
require_once(__DIR__ . "/../libros/model/libro.php");

// Fijamos la página para el paginador y nos aseguramos de que se obtiene como valor entero.
$pagina = (int) obtenerDesdeGet("pagina", 1);

//Si hay pagina Fijamos el límite para el paginador
$limite = (int) obtenerDesdeGet("limite", 10);

// Comprobamos que se haya enviado el campo por el que se orderarán los elementos por página en la url
$ordenPor = obtenerDesdeGet("ordenPor", "apellidos");

// Comprobamos que se haya enviado el orden de elementos por página en la url
$orden = obtenerDesdeGet("orden", "ASC");

// Obtenemos todos los autores de la tabla.
$resultado = librosBuscarTodos($pagina, $limite, $ordenPor, $orden, null);

// Mostramos el contenido html de la página
require(__DIR__ . "/view/ver_listado.php");