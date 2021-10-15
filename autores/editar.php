<?php
require_once(__DIR__ . '/../conexion/conexion.php');
require_once(__DIR__ . '/../view/head.php');
require_once(__DIR__ . '/model/db.php');

$idAutor = $_GET["idAutor"];

$autor = autoresBuscarUno($idAutor);

// En caso de que la solicitud sea un post (es decir, se haya enviado el form con los datos para el nuevo préstamo)
// Ejecutamos el código para agregar el nuevo préstamo en la base de datos.
if (isset($_POST) && count($_POST) > 0) {

    if (isset($_POST['nombre'])) {
        $nombre = $_POST['nombre'];
    } else {
        // error
    }
    if (isset($_POST['apellidos'])) {
        $apellidos = $_POST['apellidos'];
    } else {
        // error
    }
    if (isset($_POST['nacionalidad'])) {
        $nacionalidad = $_POST['nacionalidad'];
    } else {
        // error
    }
    if (isset($_POST['fechaNacimiento'])) {
        $fechaNacimiento = $_POST['fechaNacimiento'];
    } else {
        // error
    }

    $resultado = autoresActualizar($nombre, $apellidos, $nacionalidad, $fechaNacimiento, $idAutor);

    if ($resultado) {
        agregarMensaje("Autor actualziado correctamente", "success");
    }
}
if (hayMensajes()) {
    mostrarMensajes();
}

require(__DIR__ . '/view/editar.php');
require_once(__DIR__ . '/../view/footer.php');
