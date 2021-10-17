<?php
$nombreAutor = $autor["nombre"];
if (isset($autor["apellidos"])) {
    $nombreAutor .= " " . $autor["apellidos"];
}
?>
<div class="row">
    <div class="col-12 col-sm-10 col-xl-6 mx-md-auto my-4">
        <div class="card rounded-top border-dark bg-transparent">
            <div class="card-title bg-naranja p-3 rounded-top mb-0">
                <h1 class="mb-0"><i class="bi bi-vector-pen me-2 fs-1"></i>
                    <?= $nombreAutor ?>
                </h1>
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
                <a href="/biblioteca/autores/editar.php?idAutor=<?= $autor['idAutor'] ?>" class="btn mt-3 bg-naranja"><i
                        class="bi bi-pencil me-2"></i>Editar</a>
            </div>
        </div>
    </div>
</div>