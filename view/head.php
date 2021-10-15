<?php

// Cargamos aqui estos dos archivos para no tener que cargarlos en otras el resto de la aplicación.

// require_once es igual que 'import' con la diferencia de que si el archivo
// no se encuentra, se devuelve un error grave y se asegura que el archivo se carga
// en la memoria una sola vez. Esto sirve para no duplicar un código que queremos
// que solo se carge una vez.

// Para evitar errores usamos __DIR__ para determinar el path real de los archivos.
require_once(__DIR__ . "/../mensaje/mensaje.php");
require_once(__DIR__ . "/../error/error.php");

/**
 * Este archivo muestra el contenido html del head de la página web.
 * El head se comparte a lo largo de toda la aplicación.
 * Además incluimos la etiqueta de apertura del body y el navbar
 * que también se comparten en toda la aplicación.
 */
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteca</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
        integrity="sha512-SfTiTlX6kk+qitfevl/7LibUOeJWlt9rbyDn92a1DqWOw9vWG2MFoays0sgObmWazO5BQPiFucnnEAjpAB+/Sw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body class="pt-5">
    <?php
    // Cargamos la barra de navegación general asegurándonos de que no se vuelve a cargar en ninguna otra parte de la aplicación.
    // mediante "require_once"
    require_once("navbar.php");
    ?>
    <!-- Contenedor principal -->
    <div class="container-fluid mt-5 py-3 min-vh-100">

        <?php
        // Si se ha producido algún error grave durante la ejecución de la aplicación, mostramos una página
        // con los errores y detenemos la ejecución.
        if (hayErrores()) {

            mostrarErrores();

            //Cerramos el container y mostramos el footer.
            echo "</div>";
            require(dirname(__FILE__) . "/footer.php");
            // La aplicación termina aquí.
            die();
        }

        // si no hay ningún error grave, se termina de mostrar el contenido generado en la página correspondiente.
        ?>