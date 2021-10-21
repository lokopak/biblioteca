<?php

namespace Library\Author\Controller;

use Library\Author\Model\AuthorTable;

require_once(__DIR__ . '/../conexion/conexion.php');
require_once(__DIR__ . '/../view/head.php');
require_once(__DIR__ . "./model/AuthorTable.php");

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
  $authorTable = new AuthorTable();
  $idAutor = $authorTable->autoresInsertarNuevo($nombre, $apellidos, $nacionalidad, $fechaNacimiento);
  if ($idAutor) {
    require(__DIR__ . "/view/creado.php");
  }
} else {
  require(__DIR__ . "/view/crear.php");
}
require_once(__DIR__ . "/../view/footer.php");