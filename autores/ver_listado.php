<?php
require_once(dirname(__FILE__) . "/../view/head.php");
require_once(dirname(__FILE__) . "./model/db.php");

// Obtenemos todos los autores de la tabla.
$autores = autoresBuscarTodos();

require("./view/ver_listado.php");

require_once(dirname(__FILE__) . "/../view/footer.php");