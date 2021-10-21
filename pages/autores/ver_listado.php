<?php

namespace Library\Author\Controller;

use Library\Author\Model\AuthorTable;

require_once(__DIR__ . "/../view/head.php");
require_once(__DIR__ . "./model/AuthorTable.php");

$authorTable = new AuthorTable();
// Obtenemos todos los autores de la tabla.
$autores = $authorTable->autoresBuscarTodos();

require("./view/ver_listado.php");

require_once(__DIR__ . "/../view/footer.php");