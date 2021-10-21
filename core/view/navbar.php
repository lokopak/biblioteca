<?php

/**
 * Este archivo muestra el contenido html de la barra de navegación situada en la parte superior
 * de la web.
 * 
 * Cuando queremos que los links sean relativos al índice base de la web y así
 * no tener que preocuparnos de en que lugar de la web nos encontramos en cada
 * momento, es preferible montar los links (parámetro href) empeznado con '/'
 * seguido de la ruta completa del destino al que queremos navegar.
 * De esta forma evitamos posibles fallos en la navegación.
 */
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-verde fixed-top">
    <div class="container">
        <a class="navbar-brand" href="/biblioteca"><i class="bi bi-book-half me-3"></i>Biblioteca Laboris</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#contenidoDelTopnavbar"
            aria-controls="contenidoDelTopnavbar" aria-expanded="false" aria-label="Mostrar/Ocultar la navegación">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="contenidoDelTopnavbar">
            <ul class="navbar-nav m-auto mb-2 mb-lg-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownAutores" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-vector-pen me-1"></i>Autores
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownAutores">
                        <li>
                            <a class="dropdown-item" href="/biblioteca/autores/listado">
                                <i class="bi bi-list me-1"></i>Listado de autores</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="/biblioteca/autores/ver_listado">
                                <i class="bi bi-grid me-1"></i>Mostrar autores</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="/biblioteca/autores/crear">
                                <i class="bi bi-plus me-1"></i>Agregar nuevo autor
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownLibros" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-book me-1"></i>Libros
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownLibros">
                        <li>
                            <a class="dropdown-item" href="/biblioteca/libros/listado">
                                <i class="bi bi-list me-1"></i>Listado de libros
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="/biblioteca/libros/ver_listado">
                                <i class="bi bi-grid me-1"></i>Mostrar libros</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="/biblioteca/libros/crear">
                                <i class="bi bi-plus me-1"></i>Agregar nuevo libro
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownSocios" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-people me-1"></i>Socios
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownSocios">
                        <li>
                            <a class="dropdown-item" href="/biblioteca/socios/listado">
                                <i class="bi bi-list me-1"></i>Listado de socios
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="/biblioteca/socios/crear">
                                <i class="bi bi-plus me-1"></i>Agregar nuevo socios
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownPrestamos" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-box-arrow-right me-1"></i>Préstamos
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownPrestamos">
                        <li>
                            <a class="dropdown-item" href="/biblioteca/prestamos/listado">
                                <i class="bi bi-list me-1"></i>Listado de préstamos
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="/biblioteca/prestamos/crear">
                                <i class="bi bi-plus me-1"></i>Agregar nuevo préstamo
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>