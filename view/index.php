<?php

/**
 * Este archivo muestra el contenido html de la página de inicio de la web.
 * Este contenido es el que puede variar de una página a otra.
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

        <ul class="list-group w-25 m-auto px-5">
            <li class="list-group-item  mb-2 p-0">
                <a href="/biblioteca/autores/index.php" class="btn btn-outline-primary w-100 text-uppercase">
                    <i class="bi bi-vector-pen me-2 fs-1"></i><br />Autores
                </a>
            </li>
            <li class="list-group-item  mb-2 p-0">
                <a href="/biblioteca/libros/index.php" class="btn btn-outline-primary w-100 text-uppercase">
                    <i class="bi bi-book me-2 fs-1"></i><br />Libros
                </a>
            </li>
            <li class="list-group-item mb-2 p-0">
                <a href="/biblioteca/socios/index.php" class="btn btn-outline-primary w-100 text-uppercase">
                    <i class="bi bi-people me-2 fs-1"></i><br />Socios
                </a>
            </li>
            <li class="list-group-item  mb-2 p-0">
                <a href="/biblioteca/prestamos/index.php" class="btn btn-outline-primary w-100 text-uppercase">
                    <i class="bi bi-box-arrow-right me-2 fs-1"></i><br />Prestamos
                </a>
            </li>
        </ul>
    </div>
</div>