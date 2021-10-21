<?php

namespace Library\Author\Controller;

use Library\Author\Model\AuthorTable;

require_once(__DIR__ . '/../view/head.php');
require_once(__DIR__ . '/model/AuthorTable.php');

$idAutor = $_GET["idAutor"];

$authorTable = new AuthorTable();
$autor = $authorTable->autoresBuscarUno($idAutor);

require(__DIR__ . '/view/mostrar.php');
require_once(__DIR__ . '/../view/footer.php');