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
    <div class="col-12 col-sm-10 col-xl-6 mx-md-auto my-4">
        <div class="card border-dark bg-transparent ">
            <div class="card-title bg-naranja p-3 mb-0 text-center rounded-top">
                <h1 class="mb-0"><i class="bi bi-vector-pen me-2 fs-1"></i>Autores</h1>
            </div>
            <div class="card-body bg-white rounded-bottom">
                <div class="row row-cols-1 row-cols-md-2 g-2 g-lg-1">
                    <div class="col">
                        <a href="/biblioteca/autores/listado.php"
                            class="btn btn-outline-naranja bg-white text-uppercase w-100 py-3">
                            <i class="bi bi-vector-pen fs-1"></i><br />Listado de autores
                        </a>
                    </div>
                    <div class="col">
                        <a href="/biblioteca/autores/crear.php"
                            class="btn btn-outline-naranja bg-white text-uppercase w-100 py-3">
                            <i class="bi bi-plus-circle fs-1"></i><br>Agregar un autor
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>