<div class="row">
    <div class="col-12 my-4">
        <div class="card bg-transparent border-dark">
            <div class="card-header bg-naranja">
                <h1 class="card-title mb-0"><i class="bi bi-people me-3"></i>Listado de socios</h1>
            </div>
            <div class="card-body bg-white pt-0 px-0">
                <?php
                // Si se ha encontrado algún socio, mostramos la tabla correspondiente.
                if (count($resultado["elementos"]) > 0) {
                ?>
                <div class="row mx-0">
                    <div class="col-12 py-2 px-3 border-top border-bottom bg-naranja borde-naranja">
                        <form method="GET" class="row row-cols-lg-auto g-3">
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
                                        if ($ordenPor === 'apellidos') {
                                            echo '<option value="apellidos" selected>Ordenar por: Apellido</option>';
                                        } else {
                                            echo '<option value="apellidos">Ordenar por: Apellido</option>';
                                        }
                                        if ($ordenPor === "nombre") {
                                            echo '<option value="nombre" selected>Ordenar por: Nombre</option>';
                                        } else {
                                            echo '<option value="nombre">Ordenar por: Nombre</option>';
                                        }
                                        if ($ordenPor === "DNI") {
                                            echo '<option value="DNI" selected>Ordenar por: DNI</option>';
                                        } else {
                                            echo '<option value="DNI">Ordenar por: DNI</option>';
                                        }
                                        if ($ordenPor === "fechaNacimiento") {
                                            echo '<option value="fechaNacimiento" selected>Ordenar por: Fecha nacimiento</option>';
                                        } else {
                                            echo '<option value="fechaNacimiento">Ordenar por: Fecha nacimiento</option>';
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
                                <a class="btn btn-verde bg-white" href="/biblioteca/socios/crear.php">
                                    <i class="bi bi-plus-circle me-2"></i>Nuevo socio
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col" class="text-center">#</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Apellidos</th>
                            <th scope="col">DNI</th>
                            <th scope="col">Dirección</th>
                            <th scope="col" class="text-center">Teléfono</th>
                            <th scope="col">Email</th>
                            <th scope="col" class="text-center">Fecha de nacimiento</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach ($resultado["elementos"] as $socio) {
                            ?>
                        <tr>
                            <th scope="row" class="align-middle text-center"><?php echo $socio["idSocio"] ?></th>
                            <td class="align-middle">
                                <a class="text-decoration-none"
                                    href="/biblioteca/socios/mostrar.php?idSocio=<?= $socio['idSocio'] ?>"><?= $socio["nombre"] ?></a>
                            </td>
                            <td class="align-middle"><a class="text-decoration-none"
                                    href="/biblioteca/socios/mostrar.php?idSocio=<?= $socio['idSocio'] ?>">
                                    <?php
                                            if (isset($socio["apellidos"])) {

                                                echo $socio["apellidos"];
                                            }
                                            ?>
                                </a>
                            </td>
                            <td class="align-middle"><?= $socio["DNI"] ?></td>
                            <td class="align-middle"><?= $socio["direccion"] ?></td>
                            <td class="align-middle text-center"><?= $socio["telefono"] ?? "-" ?></td>
                            <td class="align-middle"><?= $socio["email"] ?? "-" ?></td>
                            <td class="align-middle text-center">
                                <?= date("d/m/Y", strtotime($socio["fechaNacimiento"])) ?></td>
                            <td class="align-middle">
                                <a href="/biblioteca/socios/editar.php?idSocio=<?= $socio["idSocio"] ?>"
                                    class="btn btn-outline-secondary btn-sm amarillo">
                                    <i class="bi bi-pencil fs-6"></i>
                                </a>
                                <a href="/biblioteca/socios/borrar.php?idSocio=<?= $socio["idSocio"] ?>"
                                    class="btn btn-outline-danger btn-sm">
                                    <i class="bi bi-trash fs-6"></i>
                                </a>
                            </td>
                        </tr>

                        <?php
                            } // Final del foreach
                            ?>
                    </tbody>
                </table>

            </div>

        </div>

        <?php

                    // Si se indica página o límite, mostramos el paginador.
                    if ($pagina !== null) {
                        // Cargamos el archivo necesario para manejar la tabla de autores.
                        require_once(__DIR__ . "/../../paginador/paginador.php");
        ?>
        <div class="row">
            <div class="col my-3">
                <?php mostrarPaginador("libros", $resultado); ?>
            </div>
        </div>
        <?php
                    }

                    // En caso de que no se haya encontrado algún libro, mostramos un mensaje advirtiéndolo en lugar de la tabla.
                } else {
                    echo "<p>No se ha encontrado ningún socio</p>";
                }
    ?>
    </div>
</div>