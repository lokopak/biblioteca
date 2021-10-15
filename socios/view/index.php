<?php

/**
 * Este archivo muestra el contenido html de la página de inicio de la sección de socios.
 * 
 * Cuando queremos que los links sean relativos al índice base de la web y así
 * no tener que preocuparnos de en que lugar de la web nos encontramos en cada
 * momento, es preferible montar los links (parámetro href) empeznado con '/'
 * seguido de la ruta completa del destino al que queremos navegar.
 * De esta forma evitamos posibles fallos en la navegación.
 */
?>

<div class="row">
    <div class="col-12 my-4 justify-content-center">

        <ul class="list-group w-25 m-auto">
            <li class="list-group-item  mb-2 p-0">
                <a href="/biblioteca/socios/listado.php" class="btn btn-outline-primary w-100 text-uppercase py-3">
                    <i class="bi bi-people me-2 fs-1"></i><br>Listado de socios
                </a>
            </li>
            <li class="list-group-item  mb-2 p-0">
                <a href="/biblioteca/socios/crear.php" class="btn btn-outline-primary w-100 text-uppercase py-3">
                    <i class="bi bi-plus me-2 fs-1"></i><br>Alta nuevo socio
                </a>
            </li>
        </ul>
    </div>
</div>