<div class="row">
    <div class="col-12 my-4 justify-content-center">
        <h1>Listado de autores</h1>
        <?php
        if (count($autores) > 0) {
        ?>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Apellidos</th>
                    <th scope="col">Nacionalidad</th>
                    <th scope="col">Fecha de nacimiento</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <?php
                    foreach ($autores as $autor) {
                    ?>
                <tr>
                    <th scope="row"><?php echo $autor["idAutor"] ?></th>
                    <td><a class="text-decoration-none"
                            href="/biblioteca/autores/mostrar.php?idAutor=<?= $autor['idAutor'] ?>"><?= $autor["nombre"] ?></a>
                    </td>
                    <td><a class="text-decoration-none"
                            href="/biblioteca/autores/mostrar.php?idAutor=<?= $autor['idAutor'] ?>">
                            <?php
                                    // No todos los autores llevan apellido (por ejemplo "Anónimo"), por eso nos aseguramos antes de insertarlo en la celda.
                                    if (isset($autor["apellidos"])) {

                                        echo $autor["apellidos"];
                                    }
                                    ?>
                        </a>
                    </td>
                    <td><?= $autor["nacionalidad"] ?></td>
                    <td><?= date("d/m/Y", strtotime($autor["fechaNacimiento"])) ?></td>
                    <td>
                        <a href="/biblioteca/autores/editar.php?idAutor=<?= $autor["idAutor"] ?>"
                            class="btn btn-outline-secondary btn-sm"><i class="bi bi-pencil fs-6"></i></a>
                        <a href="/biblioteca/autores/borrar.php?idAutor=<?= $autor["idAutor"] ?>"
                            class="btn btn-danger btn-sm"><i class="bi bi-trash fs-6"></i></a>
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