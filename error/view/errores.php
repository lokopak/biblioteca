<?php

/**
 * Este archivo muestra el contenido html de los errores que se han producido durante
 * la creación del contenido de la pagina solicitada y ejecución de la aplicación.
 * Cada error se compone de un array que contiene dos índices:
 *  - mensaje: El contenido del mensaje del error
 *  - tipo: Indica la procedencia del error y sirve como título.
 */
?>

<div class="row justify-content-center">
    <div class="col-12 mb-3">
        <?php
        // Recorremos el array de errores para mostrarlos.
        foreach ($errores as $error) {
        ?>
        <div class="card text-white bg-danger mb-3 w-75 m-auto">
            <div class="card-header"><?= $error["tipo"] ?></div>
            <div class="card-body">
                <p class="card-text"><?= $error["mensaje"] ?></p>
            </div>
        </div>
        <?php
        }
        ?>
    </div>
</div>