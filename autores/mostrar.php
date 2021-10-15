<?php
require_once(__DIR__ . '/../view/head.php');
require_once(__DIR__ . '/model/db.php');

$idAutor = $_GET["idAutor"];

$autor = autoresBuscarUno($idAutor);

require(__DIR__ . '/view/mostrar.php');
require_once(__DIR__ . '/../view/footer.php');
