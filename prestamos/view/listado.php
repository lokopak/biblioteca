<div class="row">
    <div class="col-12 my-4 justify-content-center">

        <h1>Listado de prestamos</h1>
        <?php
        if (count($resultado["elementos"]) > 0) {
        ?>
        <div class="row mb-3">
            <div class="col-12 py-2 border-top border-bottom">
                <form method="GET" class="row row-cols-lg-auto g-3 align-items-center">
                    <div class="col">
                        <label class="visually-hidden" for="limite">Préstamos por página:</label>
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
                                if ($ordenPor === "titulo") {
                                    echo '<option value="titulo" selected>Ordenar por: Título</option>';
                                } else {
                                    echo '<option value="titulo">Ordenar por: Título</option>';
                                }
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
                                if ($ordenPor === "fechaInicio") {
                                    echo '<option value="fechaInicio" selected>Ordenar por: Fecha de inicio</option>';
                                } else {
                                    echo '<option value="fechaInicio">Ordenar por: Fecha de inicio</option>';
                                }
                                if ($ordenPor === "fechaInicio") {
                                    echo '<option value="fechaDevolucion" selected>Ordenar por: Fecha de devolución</option>';
                                } else {
                                    echo '<option value="fechaDevolucion">Ordenar por: Fecha de devolución</option>';
                                }
                                if ($ordenPor === "estado") {
                                    echo '<option value="estado" selected>Ordenar por: Estado</option>';
                                } else {
                                    echo '<option value="estado">Ordenar por: Estado</option>';
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
                </form>
            </div>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Libro</th>
                    <th scope="col">Socio</th>
                    <th scope="col">Fecha de préstamo</th>
                    <th scope="col">Fecha de devolución</th>
                    <th scope="col">Estado</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <?php
                    // Mostramos cada elemento encontrado en una fila de la tabla.
                    foreach ($resultado["elementos"] as $prestamo) {
                        // Damos color a los estados.
                        switch ($prestamo["estado"]) {
                            case PRESTAMO_ESTADO_ACTIVO:
                                $estado = "secondary";
                                break;
                            case PRESTAMO_ESTADO_DEVUELTO:
                                $estado = "success";
                                break;
                            case PRESTAMO_ESTADO_CON_DEFECTOS:
                                $estado = "warning";
                                break;
                            case PRESTAMO_ESTADO_DEVUELTO_FUERA_PLAZO:
                                $estado = "info";
                                break;
                            case PRESTAMO_ESTADO_FUERA_PLAZO:
                                $estado = "danger";
                                break;
                            default: // Por si acaso algo ha fallado aquí.
                                $estado = "light";
                        }
                    ?>
                <tr>
                    <th scope="row"><?php echo $prestamo["idPrestamo"] ?></th>
                    <td>
                        <a class="text-decoration-none"
                            href="/biblioteca/libros/mostrar.php?idLibro=<?= $prestamo["idLibro"] ?>"><?= $prestamo["titulo"] ?></a>
                    </td>
                    <td>
                        <a class="text-decoration-none"
                            href="/biblioteca/socios/mostrar.php?idSocio=<?= $prestamo["idSocio"] ?>">
                            <?= $prestamo["nombre"] ?>
                            <?php
                                    if (isset($prestamo["apellidos"])) {
                                        echo " " . $prestamo["apellidos"];
                                    }
                                    ?>
                        </a>
                    </td>
                    <td><?= date("d/m/Y", strtotime($prestamo["fechaInicio"])) ?></td>
                    <td><?= date("d/m/Y", strtotime($prestamo["fechaDevolucion"])) ?></td>
                    <td><span
                            class="ms-2 badge rounded-pill bg-<?= $estado ?>"><?= PRESTAMO_ESTADOS[$prestamo["estado"]] ?></span>
                    </td>
                    <td>
                        <a href="/biblioteca/prestamos/editar.php?idPrestamo=<?= $prestamo["idPrestamo"] ?>"
                            class="btn btn-outline-secondary btn-sm amarillo">
                            <i class="bi bi-pencil fs-6"></i>
                        </a>
                        <a href="/biblioteca/prestamos/devolverlibro.php?idPrestamo=<?= $prestamo["idPrestamo"] ?>&estado=<?= PRESTAMO_ESTADO_DEVUELTO ?>"
                            class="btn btn-outline-success btn-sm" title="Devolver">
                            <i class="bi bi-box-arrow-left fs-6"></i>
                        </a>
                    </td>
                </tr>

                <?php
                    }
                    ?>
            </tbody>
        </table>

        <?php

            // Si se indica página o límite, mostramos el paginador.
            if ($pagina !== null) {
                // Cargamos el archivo necesario para manejar la tabla de autores.
                require_once("../paginador/paginador.php");
            ?>
        <div class=" row">
            <div class="col my-3">
                <?php mostrarPaginador("prestamos", $resultado); ?>
            </div>
        </div>
        <?php
            }
        } else {
            echo "<p>No se ha encontrado ningún préstamo</p>";
        }
        ?>

    </div>
</div>