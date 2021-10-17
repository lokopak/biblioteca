<?php
// Mostramos el contenido html del head de la página
require_once(__DIR__ . "/../../view/head.php");
?>

<div class="container-xl">
    <div class="row mb-5 bg-naranja rounded">
        <h1 class="text-black text-uppercase text-center mb-0 py-3"><i class="bi bi-book me-3"></i> Listado de
            libros</h1>
    </div>
    <?php
    // Si se ha encontrado algún libro, mostramos la tabla correspondiente.
    if (count($resultado) > 0) {
    ?>
    <form method="GET" class="row row-cols-2 row-cols-lg-auto gy-3 gy-lg-0 gx-3 bg-white mb-5 py-2 rounded">
        <div class="col">
            <label class="visually-hidden" for="limite">Libros por página:</label>
            <select class="form-select" id="limite" name="limite">
                <?php
                    if ($limite === 10) {
                        echo '<option value="10" selected>Límite: 10</option>';
                    } else {
                        echo '<option value="10">Límite: 10</option>';
                    }
                    if ($limite === 20) {
                        echo '<option value="20" selected>Límite: 20</option>';
                    } else {
                        echo '<option value="20">Límite: 20</option>';
                    }
                    if ($limite === 50) {
                        echo '<option value="50" selected>Límite: 50</option>';
                    } else {
                        echo '<option value="50">Límite: 50</option>';
                    }
                    ?>
            </select>
        </div>
        <div class="col">
            <label class="visually-hidden" for="ordenPor">Ordenar por:</label>
            <select class="form-select" id="ordenPor" name="ordenPor">
                <?php
                    if ($ordenPor === 'titulo') {
                        echo '<option value="titulo" selected>Ordenar por: Título</option>';
                    } else {
                        echo '<option value="titulo">Ordenar por: Título</option>';
                    }
                    if ($ordenPor === "editorial") {
                        echo '<option value="editorial" selected>Ordenar por: Editorial</option>';
                    } else {
                        echo '<option value="editorial">Ordenar por: Editorial</option>';
                    }
                    if ($ordenPor === "genero") {
                        echo '<option value="genero" selected>Ordenar por: Género</option>';
                    } else {
                        echo '<option value="genero">Ordenar por: Género</option>';
                    }
                    if ($ordenPor === "ISBN") {
                        echo '<option value="ISBN" selected>Ordenar por: ISBN</option>';
                    } else {
                        echo '<option value="ISBN">Ordenar por: ISBN</option>';
                    }
                    if ($ordenPor === "anhoPublicacion") {
                        echo '<option value="anhoPublicacion" selected>Ordenar por: Año de publicación</option>';
                    } else {
                        echo '<option value="anhoPublicacion">Ordenar por: Año de publicación</option>';
                    }
                    ?>
            </select>
        </div>
        <div class="col">
            <label class="visually-hidden" for="orden">Ordenar:</label>
            <select class="form-select" id="orden" name="orden">
                <?php
                    if ($orden === "ASC") {
                        echo '<option value="ASC" selected>Ordenar A -> Z</option>';
                    } else {
                        echo '<option value="ASC">Ordenar A -> Z</option>';
                    }
                    if ($orden === "DESC") {
                        echo '<option value="DESC" selected>Ordenar Z -> A</option>';
                    } else {
                        echo '<option value="DESC">Ordenar Z -> A</option>';
                    }
                    ?>
            </select>
        </div>
        <div class="col">
            <button type="submit" class="btn btn-verde">
                <i class="bi bi-arrow-clockwise me-2"></i>Actualizar
            </button>
        </div>

        <div class="col ms-auto me-5">
            <a class="btn btn-verde" href="/biblioteca/libros/crear.php">
                <i class="bi bi-plus-circle me-2"></i>
                Agregar nuevo libro
            </a>

        </div>
    </form>
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 g-3 mb-5">
        <?php
            foreach ($resultado["elementos"] as $libro) {
                // Damos color a los estados.
                switch ($libro["estado"]) {
                    case LIBRO_ESTADO_NO_DISPONIBLE:
                        $estado = "secondary";
                        break;
                    case LIBRO_ESTADO_DISPONIBLE:
                        $estado = "success";
                        break;
                    case LIBRO_ESTADO_DETERIORADO:
                        $estado = "warning";
                        break;
                    case LIBRO_ESTADO_PRESTADO:
                        $estado = "danger";
                        break;
                }


            ?>
        <div class="col card-group">
            <div class="card shadow-sm rounded-3">
                <img src="/biblioteca/assets/images/book-no-image.png" class="img-fluid rounded-start"
                    alt="<?= $libro['titulo'] ?>">
                <div class="card-header bg-naranja">
                    <h5 class="card-title text-upercase text-nowrap text-truncate"><?= $libro["titulo"] ?></h5>
                </div>
                <div class="card-body">
                    <p class="card-text text-black text-end">

                        <?php
                                $autores = "";
                                foreach ($libro["autores"] as $key => $autor) {
                                    $autores .= '<a class="text-decoration-none text-upercase text-black"
                                    href="/biblioteca/autores/mostrar.php?idAutor=' . $autor['idAutor'] . '">' . $autor["nombre"];
                                    if (isset($autor["apellidos"])) {
                                        $autores .= " " . $autor["apellidos"];
                                    }
                                    $autores .= "</a>";
                                    if ($key >= 0 && $key < count($libro["autores"]) - 1) {
                                        $autores .= "<br/>";
                                    }
                                }

                                echo $autores;
                                ?>
                    </p>

                    <p class="card-text text-black"><span
                            class="fw-bold me-3">Editorial:</span><?= $libro["editorial"] ?>
                    </p>
                    <p class="card-text text-black"><span class="fw-bold me-3">Género:</span><?= $libro["genero"] ?>
                    </p>
                    <p class="card-text text-black"><span class="fw-bold me-3">ISBN:</span><?= $libro["isbn"] ?></p>
                    <p class="card-text text-black"><span class="fw-bold me-3">Año de
                            edición:</span><?= $libro["anhoPublicacion"] ?></p>
                </div>
                <div class="d-flex justify-content-between align-items-center card-footer">
                    <div class="btn-group">
                        <a href="/biblioteca/libros/editar.php?idLibro=<?= $libro["idLibro"] ?>"
                            class="btn btn-outline-dark btn-sm amarillo"><i class="bi bi-pencil"></i></a>
                    </div>
                    <?php if (isset($estado)) { ?>
                    <span
                        class="ms-auto badge rounded-pill py-2 bg-<?= $estado ?>"><?= LIBRO_ESTADOS[$libro['estado']] ?></span>
                    <?php } ?>
                </div>
            </div>
        </div>

        <?php
            }
            ?>

    </div>

    <div class="row align-items-center">
        <div class="col my-3">
            <?php mostrarPaginador("libros", $resultado); ?>
        </div>
    </div>
    <?php
    }

    // En caso de que no se haya encontrado algún libro, mostramos un mensaje advirtiéndolo en lugar de la tabla.
    else {
    ?>
    <div class="row align-items-center">
        <div class="col">

            <p class="py-2">No se ha encontrado ningún libro</p>
        </div>
    </div>
</div>

<?php
    }
    // Mostramos el footer de la página.
    require_once(__DIR__ . "/../../view/footer.php");
?>