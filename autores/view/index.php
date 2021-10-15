<?php

/**
 * Este archivo muestra el contenido html de la página de inicio de la sección de autores.
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
                <a href="/biblioteca/autores/listado.php" class="btn btn-outline-primary w-100 text-uppercase">
                    <i class="bi bi-vector-pen me-2 fs-1"></i><br />Listado de autores
                </a>
            </li>
            <li class="list-group-item  mb-2 p-0">
                <a href="autores.php" class="btn btn-outline-primary w-100 text-uppercase">
                    <i class="bi bi-plus me-2 fs-1"></i><br>Agregar un autor
                </a>
            </li>

        </ul>
    </div>
</div>