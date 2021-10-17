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
    if (count($autores) > 0) {
    ?>
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3 mb-5">
        <?php
            foreach ($autores as $autor) {
                $nombreAutor = $autor["nombre"];
                if (isset($autor["apellidos"])) {
                    $nombreAutor .= " " . $autor["apellidos"];
                }
            ?>
        <div class="col card-group">
            <div class="card rounded-top border-dark bg-transparent">
                <div class="card-title bg-naranja p-3 rounded-top mb-0">
                    <h3 class="mb-0 text-nowrap text-truncate"><i class="bi bi-vector-pen me-2"></i>
                        <?= $nombreAutor ?>
                    </h3>
                </div>
                <div class="card-body bg-white rounded-bottom">
                    <div class="row mb-3">
                        <div class="col-12 col-md-4 mb-3">
                            <img src="/biblioteca/assets/images/person-no-image.png" class="img-fluid rounded-start"
                                alt="<?= $nombreAutor ?>">
                        </div>
                        <div class="col-12 col-md-8">
                            <p class="card-text">
                                <i class="bi bi-globe2 me-2"></i>
                                <span class="fw-bold me-3">Nacionalidad:</span><?= $autor['nacionalidad'] ?>
                            </p>
                            <p class="card-text">
                                <i class="bi bi-calendar me-2"></i>
                                <span class="fw-bold me-3">Fecha de nacimiento</span><?= $autor['fechaNacimiento'] ?>
                            </p>
                        </div>
                    </div>
                    <a href="/biblioteca/autores/editar.php?idAutor=<?= $autor['idAutor'] ?>"
                        class="btn mt-3 bg-naranja"><i class="bi bi-pencil me-2"></i>Editar</a>
                </div>
            </div>
        </div>
        <?php
            }
            ?>
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