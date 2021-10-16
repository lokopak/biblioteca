<div class="row">
    <div class="col-12 my-4 justify-content-center">
        <h1>Listado de socios</h1>
        <?php
        // Si se ha encontrado algún socio, mostramos la tabla correspondiente.
        if (count($resultado["elementos"]) > 0) {
        ?>
        <div class="row mb-3">
            <div class="col-12 py-2 border-top border-bottom">
                <form method="GET" class="row row-cols-lg-auto g-3 align-items-center">
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
                        <button type="submit" class="btn btn-primary">Actualizar</button>
                    </div>

                    <div class="col ms-auto">
                        <a class="btn btn-success" href="/biblioteca/socios/crear.php"><i
                                class="bi bi-plus-circle me-2"></i>Nuevo
                            socio</a>
                    </div>
                </form>
            </div>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Apellidos</th>
                    <th scope="col">DNI</th>
                    <th scope="col">Dirección</th>
                    <th scope="col">Teléfono</th>
                    <th scope="col">Email</th>
                    <th scope="col">Fecha de nacimiento</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                    foreach ($resultado["elementos"] as $socio) {
                    ?>
                <tr>
                    <th scope="row"><?php echo $socio["idSocio"] ?></th>
                    <td>
                        <a class="text-decoration-none"
                            href="/biblioteca/socios/mostrar.php?idSocio=<?= $socio['idSocio'] ?>"><?= $socio["nombre"] ?></a>
                    </td>
                    <td><a class="text-decoration-none"
                            href="/biblioteca/socios/mostrar.php?idSocio=<?= $socio['idSocio'] ?>">
                            <?php
                                    if (isset($socio["apellidos"])) {

                                        echo $socio["apellidos"];
                                    }
                                    ?>
                        </a>
                    </td>
                    <td><?= $socio["DNI"] ?></td>
                    <td><?= $socio["direccion"] ?></td>
                    <td><?= $socio["telefono"] ?? "-" ?></td>
                    <td><?= $socio["email"] ?? "-" ?></td>
                    <td><?= date("d/m/Y", strtotime($socio["fechaNacimiento"])) ?></td>
                    <td>
                        <a href="/biblioteca/socios/editar.php?idSocio=<?= $socio["idSocio"] ?>"
                            class="btn btn-outline-secondary btn-sm"><i class="bi bi-pencil fs-6"></i></a>
                    </td>
                </tr>

                <?php
                    } // Final del foreach
                    ?>
            </tbody>
        </table>

        <?php

            // Si se indica página o límite, mostramos el paginador.
            if ($pagina !== null) {
                // Cargamos el archivo necesario para manejar la tabla de autores.
                require_once(__DIR__ . "/../../paginador/paginador.php");
            ?>
        <div class=" row">
            <div class="col my-3">
                <?php mostrarPaginador("socios", $resultado); ?>
            </div>
        </div>
        <?php
            }
        } else {
            echo "<p>No se ha encontrado ningún socio</p>";
        }
        ?>
    </div>
</div>