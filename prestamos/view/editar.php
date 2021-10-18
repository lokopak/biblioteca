<div class="row">
    <div class="col-12 col-sm-10 col-xl-6 mx-md-auto my-4">
        <?php
        if (hayErrores()) {

            mostrarErrores();
        } else {
            if (hayMensajes()) {
                mostrarMensajes();
            }
        ?>

        <form method="POST" action="/biblioteca/prestamos/editar.php?idPrestamo=<?= $prestamo["idPrestamo"] ?>">

            <div class="card rounded-top border-dark bg-transparent">
                <div class="card-title bg-naranja p-3 rounded-top mb-0">
                    <h1 class="mb-0"><i class="bi bi-box-arrow-right me-2 fs-1"></i>Editar prestamo</h1>
                </div>
                <div class="card-body bg-white rounded-bottom">
                    <div class="row mb-3">
                        <div class="col">
                            <label for="libro" class="form-label"><i class="bi bi-book me-2"></i>Libro</label>
                            <select class="form-select" aria-label=".form-select-lg example" name="idLibro" id="idLibro"
                                readonly>
                                <option value="0" selected>Seleccionar un libro</option>
                                <?php
                                    foreach ($libros["elementos"] as $libro) {
                                        if ((int)$libro["idLibro"] === (int)$prestamo["idLibro"]) {

                                            echo "<option value=" . $libro["idLibro"] . " selected>" . $libro["titulo"] . "</option>";
                                        } else {
                                            echo "<option value=" . $libro["idLibro"] . ">" . $libro["titulo"] . "</option>";
                                        }
                                    }
                                    ?>

                            </select>

                        </div>
                        <div class="col">
                            <label class="form-label" for="socio"><i class="bi bi-person me-2"></i>Socio</label>
                            <select class="form-select" aria-label=".form-select-lg example" name="idSocio"
                                id="idSocio">
                                <option value="0" selected>Seleccionar un socio</option>
                                <?php
                                    // los Socios tembién vienen paginados.
                                    foreach ($socios["elementos"] as $socio) {
                                        if ((int)$socio["idSocio"] === (int)$prestamo["idSocio"]) {
                                            echo "<option value=" . $socio["idSocio"] . " selected>" . $socio["nombre"] . " " . $socio["apellidos"] . "</option>";
                                        } else {
                                            echo "<option value=" . $socio["idSocio"] . ">" . $socio["nombre"] . " " . $socio["apellidos"] . "</option>";
                                        }
                                    }
                                    ?>

                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-6">
                            <label class="form-label" for="fecha_nacimiento"><i class="bi bi-calendar4 me-2"></i>Fecha
                                de inicio</label>
                            <input class="form-control" type="date" name="fechaInicio"
                                value="<?= $prestamo["fechaInicio"] ?>">
                        </div>
                        <div class="col-6">
                            <label class="form-label" for="fecha_nacimiento"><i class="bi bi-calendar4 me-2"></i>Fecha
                                de devolución</label>
                            <input class="form-control" type="date" name="fechaDevolucion"
                                value="<?= $prestamo["fechaDevolucion"] ?>">
                        </div>

                    </div>

                    <div class="row mb-3">
                        <div class="col">
                            <label class="form-check-label me-2" for="estado">Estado del préstamo:</label>
                            <div class="form-check form-check-inline">
                                <?php if ((int)$prestamo["estado"] === PRESTAMO_ESTADO_DEVUELTO) { ?>
                                <input class="form-check-input" type="radio" name="estado" id="estado"
                                    value="<?= PRESTAMO_ESTADO_DEVUELTO ?>" checked>
                                <?php } else { ?>
                                <input class="form-check-input" type="radio" name="estado" id="estado"
                                    value="<?= PRESTAMO_ESTADO_DEVUELTO ?>">
                                <?php } ?>
                                <label class="form-check-label" for="estado">Devuelto</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <?php if ((int)$prestamo["estado"] === PRESTAMO_ESTADO_ACTIVO) { ?>
                                <input class="form-check-input" type="radio" name="estado" id="estado"
                                    value="<?= PRESTAMO_ESTADO_ACTIVO ?>" checked>
                                <?php } else { ?>
                                <input class="form-check-input" type="radio" name="estado" id="estado"
                                    value="<?= PRESTAMO_ESTADO_ACTIVO ?>">
                                <?php } ?>
                                <label class="form-check-label" for="estado">Activo</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <?php if ((int)$prestamo["estado"] === PRESTAMO_ESTADO_FUERA_PLAZO) { ?>
                                <input class="form-check-input" type="radio" name="estado" id="estado"
                                    value="<?= PRESTAMO_ESTADO_FUERA_PLAZO ?>" checked>
                                <?php } else { ?>
                                <input class="form-check-input" type="radio" name="estado" id="estado"
                                    value="<?= PRESTAMO_ESTADO_FUERA_PLAZO ?>">
                                <?php } ?>
                                <label class="form-check-label" for="estado">Fuera de plazo</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <?php if ((int)$prestamo["estado"] === PRESTAMO_ESTADO_CON_DEFECTOS) { ?>
                                <input class="form-check-input" type="radio" name="estado" id="estado"
                                    value="<?= PRESTAMO_ESTADO_CON_DEFECTOS ?>" checked>
                                <?php } else { ?>
                                <input class="form-check-input" type="radio" name="estado" id="estado"
                                    value="<?= PRESTAMO_ESTADO_CON_DEFECTOS ?>">
                                <?php } ?>
                                <label class="form-check-label" for="estado">Con defectos</label>
                            </div>

                        </div>
                    </div>
                    <button type="submit" class="btn mt-3 bg-naranja"><i class="bi bi-save me-2"></i>Guardar</button>
                    <input type="hidden" name="idPrestamo" value="<?= $prestamo["idPrestamo"] ?>">
                </div>
            </div>
        </form>

        <?php
        }
        ?>
    </div>
</div>