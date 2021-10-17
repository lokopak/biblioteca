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
    <div class="col-12 col-sm-10 col-xl-6 mx-md-auto my-4">
        <?php
        if (isset($errores) && !empty($errores)) {
            // Recorremos el array de errores para mostrarlos.
            foreach ($errores as $error) {
        ?>
        <div class="card mb-3">
            <div class="card-header bg-danger text-white text-center">
                <h1 class="card-title"><i class="bi bi-exclamation-triangle me-3"></i><?= $error["tipo"] ?></h1>
            </div>
            <div class="card-body bg-white">
                <div class="w-100 text-center">
                    <span class="card-title"><i class="bi bi-exclamation-octagon fs-1 text-danger"></i></span>
                </div>
                <p class="card-text"><?= $error["mensaje"] ?></p>
            </div>
        </div>
        <?php
            }
        }
        ?>
    </div>
</div>

<?php

require_once(dirname(__FILE__) . "/../../view/footer.php");