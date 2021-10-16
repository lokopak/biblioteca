<div class="row">
    <div class="col-12 my-4 justify-content-center">
        <?php
        if (hayErrores()) {

            mostrarErrores();
        } else {
            if (hayMensajes()) {
                mostrarMensajes();
            }
        ?>

        <form method="POST" action="/biblioteca/prestamos/editar.php?idPrestamo=<?= $prestamo["idPrestamo"] ?>"
            class="w-50 m-auto">
            <h1>Editar prestamo</h1>
            <div class="row mb-3">
                <div class="col">
                    <label for="libro" class="form-label">Libro</label>
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
                    <label class="form-label" for="socio">Socio</label>
                    <select class="form-select" aria-label=".form-select-lg example" name="idSocio" id="idSocio">
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
                <div class="col">
                    <label class="form-label" for="fecha_nacimiento">Fecha de inicio</label>
                    <input class="form-control" type="date" name="fechaInicio" value="<?= $prestamo["fechaInicio"] ?>">
                </div>
                <div class="col">
                    <label class="form-label" for="fecha_nacimiento">Fecha de devolución</label>
                    <input class="form-control" type="date" name="fechaDevolucion"
                        value="<?= $prestamo["fechaDevolucion"] ?>">
                </div>

            </div>

            <div class="col mb-3">
                <label class="form-check-label me-2" for="estado">Estado del préstamo:</label>
                <div class="form-check form-check-inline">
                    <?php if ($prestamo["estado"] === 0) { ?>
                    <input class="form-check-input" type="radio" name="estado" id="estado" value="0" checked>
                    <?php } else { ?>
                    <input class="form-check-input" type="radio" name="estado" id="estado" value="0">
                    <?php } ?>
                    <label class="form-check-label" for="estado">Devuelto</label>
                </div>
                <div class="form-check form-check-inline">
                    <?php if ((int)$prestamo["estado"] === 1) { ?>
                    <input class="form-check-input" type="radio" name="estado" id="estado" value="1" checked>
                    <?php } else { ?>
                    <input class="form-check-input" type="radio" name="estado" id="estado" value="1">
                    <?php } ?>
                    <label class="form-check-label" for="estado">Activo</label>
                </div>
                <div class="form-check form-check-inline">
                    <?php if ((int)$prestamo["estado"] === 2) { ?>
                    <input class="form-check-input" type="radio" name="estado" id="estado" value="2" checked>
                    <?php } else { ?>
                    <input class="form-check-input" type="radio" name="estado" id="estado" value="2">
                    <?php } ?>
                    <label class="form-check-label" for="estado">Fuera de plazo</label>
                </div>
                <div class="form-check form-check-inline">
                    <?php if ((int)$prestamo["estado"] === 3) { ?>
                    <input class="form-check-input" type="radio" name="estado" id="estado" value="3" checked>
                    <?php } else { ?>
                    <input class="form-check-input" type="radio" name="estado" id="estado" value="3">
                    <?php } ?>
                    <label class="form-check-label" for="estado">Con defectos</label>
                </div>

            </div>
            <input type="hidden" name="idPrestamo" value="<?= $prestamo["idPrestamo"] ?>">
            <button type="submit" class="btn btn-danger">Guardar</button>
        </form>

        <?php
        }
        ?>
    </div>
</div>