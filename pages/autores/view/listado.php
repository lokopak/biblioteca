<div class="row">
    <div class="col-12 my-4">
        <div class="card bg-transparent border-dark">
            <div class="card-header bg-naranja">
                <h1 class="card-title mb-0"><i class="bi bi-vector-pen me-3"></i>Listado de autores</h1>
            </div>
            <div class="card-body bg-white pt-0 px-0">
                <?php
                if (count($autores) > 0) {
                ?>
                <div class="row mx-0">
                    <div class="col-12 py-2 px-3 border-bottom bg-naranja">
                        <div class="row row-cols-lg-auto gx-3">
                            <div class="col ms-auto me-5">
                                <a class="btn btn-verde bg-white" href="/biblioteca/autores/crear.php">
                                    <i class="bi bi-vector-pen me-2"></i>
                                    Nuevo autor
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col" class="text-center">#</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Apellidos</th>
                            <th scope="col">Nacionalidad</th>
                            <th scope="col">Fecha de nacimiento</th>
                            <th scope="col">Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach ($autores as $autor) {
                            ?>
                        <tr>
                            <th scope="row" class="align-middle text-center"><?= $autor["idAutor"] ?></th>
                            <td class="align-middle">
                                <a class="text-decoration-none"
                                    href="/biblioteca/autores/mostrar.php?idAutor=<?= $autor['idAutor'] ?>">
                                    <?= $autor["nombre"] ?>
                                </a>
                            </td>
                            <td class="align-middle">
                                <a class="text-decoration-none"
                                    href="/biblioteca/autores/mostrar.php?idAutor=<?= $autor['idAutor'] ?>">
                                    <?php
                                            // No todos los autores llevan apellido (por ejemplo "Anónimo"), por eso nos aseguramos antes de insertarlo en la celda.
                                            if (isset($autor["apellidos"])) {
                                                echo $autor["apellidos"];
                                            }
                                            ?>
                                </a>
                            </td>
                            <td class="align-middle"><?= $autor["nacionalidad"] ?></td>
                            <td class="align-middle">
                                <?php if (is_null($autor['fechaNacimiento'])) { ?>
                                --/--/----
                                <?php } else { ?>
                                <?= date("d/m/Y", strtotime($autor["fechaNacimiento"])) ?>
                                <?php } ?>
                            </td>
                            <td class="align-middle">
                                <a href="/biblioteca/autores/editar.php?idAutor=<?= $autor["idAutor"] ?>"
                                    class="btn btn-outline-secondary btn-sm amarillo"><i class="bi bi-pencil"></i></a>
                                <a href="/biblioteca/autores/borrar.php?idAutor=<?= $autor["idAutor"] ?>"
                                    class="btn btn-outline-danger btn-sm"><i class="bi bi-trash"></i></a>
                            </td>
                        </tr>
                        <?php
                            }
                            ?>
                    </tbody>
                </table>

                <?php
                } else {
                    echo "<p>No se ha encontrado ningún autor</p>";
                }
                ?>

            </div>
        </div>
    </div>
</div>