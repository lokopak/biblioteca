<?php

// Mostramos el contenido html del head
require_once(__DIR__ . "/../../../core/view/head.php");
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
    <div class="col-12 col-xl-6 mx-md-auto my-4">
        <div class="card border-dark bg-transparent">
            <div class="card-title bg-naranja p-3 mb-0 text-center rounded-top">
                <h1 class="mb-0"><i class="bi bi-book me-2 fs-1"></i>Bienvenido</h1>
            </div>
            <div class="card-body bg-naranja">

                <div class="row row-cols-1 row-cols-sm-2 gx-3 px-5">
                    <div class="col mb-2 p-0">
                        <a href="/biblioteca/autores/index.php"
                            class="btn btn-outline-naranja bg-white w-100 text-uppercase py-5">
                            <i class="bi bi-vector-pen fs-1"></i><br />Autores
                        </a>
                    </div>
                    <div class="col mb-2 p-0">
                        <a href="/biblioteca/libros/index.php"
                            class="btn btn-outline-naranja bg-white w-100 text-uppercase py-5">
                            <i class="bi bi-book fs-1"></i><br />Libros
                        </a>
                    </div>
                    <div class="col mb-2 p-0">
                        <a href="/biblioteca/socios/index.php"
                            class="btn btn-outline-naranja bg-white w-100 text-uppercase py-5">
                            <i class="bi bi-people fs-1"></i><br />Socios
                        </a>
                    </div>
                    <div class="col mb-2 p-0">
                        <a href="/biblioteca/prestamos/index.php"
                            class="btn btn-outline-naranja bg-white w-100 text-uppercase py-5">
                            <i class="bi bi-box-arrow-right fs-1"></i><br />Prestamos
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php

// Mostramos el contenido html del footer
require_once(__DIR__ . "/../../../core/view/footer.php");
?>