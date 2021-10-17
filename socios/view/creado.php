<?php

/**
 * Este archivo muestra el contenido html de la página a mostrar una vez crearo un nuevo elemento.
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
            <div class="card-header bg-naranja texto-verde p-3 mb-0 text-center rounded-top">
                <h4 class="card-title"><i class="bi bi-emoji-sunglasses fs-1"></i><br>¡ Listo !</h4>
                <h5 class="card-title texto-white">El socio ha sido agregado correctamente.</h5>
            </div>
            <div class="card-body bg-white">

                <div class="row row-cols-1 row-cols-sm-3 g-3 px-1">
                    <div class="col">
                        <a href="/biblioteca/socios/listado.php" class="btn btn-naranja w-100 text-uppercase py-3">
                            <i class="bi bi-list fs-1"></i><br>Listado de socios
                        </a>
                        </li>
                    </div>
                    <div class="col">
                        <a href="/biblioteca/socios/crear.php" class="btn btn-naranja w-100 text-uppercase py-3">
                            <i class="bi bi-plus-circle fs-1"></i><br>Nuevo socio
                        </a>
                    </div>
                    <div class="col">
                        <a href="/biblioteca/socios/editar.php?idAutor=<?= $idAutor ?>"
                            class="btn btn-naranja w-100 text-uppercase py-3">
                            <i class="bi bi-pencil fs-1"></i><br>Editar el socio
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>