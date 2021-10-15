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

<div class="container-fluid">
    <div class="row">
        <div class="col-12 my-4 justify-content-center">
            <div class="alert alert-success text-center w-50 m-auto" role="alert">
                <i class="bi bi-emoji-sunglasses fs-1"></i><br>
                <h4 class="alert-heading">¡ Listo !</h4>
                <p>El autor ha sido agregado correctamente.</p>
            </div>
        </div>
        <div class="col-12 my-4 justify-content-center">
            <ul class="list-group w-25 m-auto">
                <li class="list-group-item  mb-2 p-0">
                    <a href="/biblioteca/autores/listado.php" class="btn btn-outline-primary w-100 text-uppercase py-3">
                        <i class="bi bi-vector-pen me-2 fs-1"></i><br>Listado de autores
                    </a>
                </li>
                <li class="list-group-item  mb-2 p-0">
                    <a href="/biblioteca/autores/crear.php" class="btn btn-outline-primary w-100 text-uppercase py-3">
                        <i class="bi bi-plus-circle me-2 fs-1"></i><br>Agregar otro autor
                    </a>
                </li>
                <li class="list-group-item  mb-2 p-0">
                    <a href="/biblioteca/autores/editar.php?idAutor=<?= $idAutor ?>"
                        class="btn btn-outline-primary w-100 text-uppercase py-3">
                        <i class="bi bi-pencil-square me-2 fs-1"></i><br>Editar el autor
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>