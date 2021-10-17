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

    // Recogemos todos los datos desde el POST
    $titulo = obtenerDesdePost('titulo', null);
    $editorial = obtenerDesdePost('editorial', null);
    $genero = obtenerDesdePost('genero', null);
    // El valor del género es un entero, lo convertimos al string correspondiente al nombre.
    if ($genero) {
        $genero = GENEROS_LITERARIOS[$genero];
    }
    // NOTA: En lugar de asignar desconocido, habría que agregar un mensaje de error.
    else {
        $genero = "Desconocido";
    }
    $isbn = obtenerDesdePost('isbn', null);
    $anhoPublicacion  = obtenerDesdePost('anhoPublicacion', null);

    $autores = obtenerDesdePost("autores", []);
    // Aquí habría que comprobar que todos los autores existen.

    // En principio el libro se da de alta como disponible.
    $estado = LIBRO_ESTADO_DISPONIBLE;

    // Agregamos a los datos la fecha de hoy como fecha de alta.
    $fechaAlta = date("Y/m/d", time());
    $resultado = librosInsertarNuevo($titulo, $editorial, $genero, $isbn, (int)$anhoPublicacion, $fechaAlta, $autores, (int)$estado);

    // Si se ha insertado correctamente...
    if ($resultado) {

        require(__DIR__ . "/view/creado.php");
        return;
    }
    // De lo contrario
    else {
        agregarMensaje("No se ha podido agregadar el libro correctamete", "warning");
    }
}

// En caso contrario, simplemente mostramos el form. Si hubiera algún error en los datos se podrían mostrar
require(__DIR__ . "/view/crear.php");

require_once(__DIR__ . '/../view/footer.php');