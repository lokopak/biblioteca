<?php
include_once(dirname(__FILE__) . '/../conexion/conexion.php');
include_once(dirname(__FILE__) . '/../view/head.php');

// En caso de que la solicitud sea un post (es decir, se haya enviado el form con los datos para el nuevo préstamo)
// Ejecutamos el código para agregar el nuevo préstamo en la base de datos.
if (isset($_POST) && count($_POST) > 0) {

  require(dirname(__FILE__) . "./model/db.php");

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

  $idAutor = autoresInsertarNuevo($nombre, $apellidos, $nacionalidad, $fechaNacimiento);
  if ($idAutor) {
    require(__DIR__ . "/view/creado.php");
  }
} else {
  require(__DIR__ . "/view/crear.php");
}
require_once(dirname(__FILE__) . "/../view/footer.php");
