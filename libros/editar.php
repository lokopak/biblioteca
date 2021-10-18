<?php

// Mostramos el contenido html del head
require_once(__DIR__ . "/../view/head.php");
require_once(__DIR__ . '/model/db.php');
require_once(__DIR__ . '/../autores/model/db.php');



$idLibro = $_GET["idLibro"];

$libro = librosBuscarUno($idLibro);
$autores = autoresBuscarTodos();

// En caso de que la solicitud sea un post (es decir, se haya enviado el form con los datos para el nuevo préstamo)
// Ejecutamos el código para agregar el nuevo préstamo en la base de datos.
if (isset($_POST) && count($_POST) > 0) {

    if (isset($_POST['titulo'])) {
        $titulo = $_POST['titulo'];
    } else {
        // error
    }
    if (isset($_POST['editorial'])) {
        $editorial = $_POST['editorial'];
    } else {
        // error
    }
    if (isset($_POST['genero'])) {
        $genero = $_POST['genero'];
    } else {
        // error
    }
    if (isset($_POST['isbn'])) {
        $isbn = $_POST['isbn'];
    } else {
        // error
    }
    if (isset($_POST['anhoPublicacion'])) {
        $anhoPublicacion = $_POST['anhoPublicacion'];
    } else {
        // error
    }
    if (isset($_POST['autores'])) {
        $autores = $_POST['autores'];
    } else {
        // error
    }


    $resultado = librosActualizar($titulo, $editorial, (int) $genero, $isbn, $anhoPublicacion, $autores, (int) $idLibro);

    if ($resultado) {
        agregarMensaje("Libro actualizado correctamente", "success");
    }

    $libro = librosBuscarUno($idLibro);
}

if (hayMensajes()) {
    mostrarMensajes();
}
// Mostramos el contenido html de la página
require(__DIR__ . "/view/editar.php");

// Mostramos el contenido html del footer.
require_once(__DIR__ . "/../view/footer.php");