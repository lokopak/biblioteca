<?php

namespace Library\Author\Controller;

use Library\Author\Model\AuthorTable;

require_once(__DIR__ . "/../view/head.php");
// Cargamos el archivo necesario para manejar la tabla de autores.
require_once(__DIR__ . "/model/AuthorTable.php");

$authorTable = new AuthorTable();
// Obtenemos todos los autores de la tabla.
$autores = $authorTable->autoresBuscarTodos();

require("./view/listado.php");

require_once(__DIR__ . "/../view/footer.php");