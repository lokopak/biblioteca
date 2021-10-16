<div class="row">
    <div class="col-12 my-4 justify-content-center">

        <form method="POST" action="/biblioteca/prestamos/crear.php" class="w-50 m-auto">
            <h1>Crear prestamo</h1>
            <div class="row mb-3">
                <div class="col">
                    <label for="libro" class="form-label">Libro</label>
                    <select class="form-select" aria-label=".form-select-lg example" name="libro" id="libro">
                        <option value="0" selected>Seleccionar un libro</option>
                        <?php

                        foreach ($libros["elementos"] as $libro) {
                            echo "<option value=" . $libro["idLibro"] . ">" . $libro["titulo"] . "</option>";
                        }
                        ?>

                    </select>

                </div>
                <div class="col">
                    <label class="form-label" for="socio">Socio</label>
                    <select class="form-select" aria-label=".form-select-lg example" name="socio" id="socio">
                        <option value="0" selected>Seleccionar un socio</option>
                        <?php

                        foreach ($socios["elementos"] as $socio) {
                            echo "<option value=" . $socio["idSocio"] . ">" . $socio["apellidos"] . ", " . $socio["nombre"] . "</option>";
                        }
                        ?>

                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-6">
                    <label class="form-label" for="fecha_nacimiento">Fecha de inicio</label>
                    <input class="form-control" type="date" name="fechaInicio" default value="<?= date('Y-m-d') ?>">
                </div>

            </div>
            <button type="submit" class="btn btn-danger">Guardar</button>
        </form>
    </div>
</div>