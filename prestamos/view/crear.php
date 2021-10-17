<div class="row">
    <div class="col-12 col-sm-10 col-xl-6 mx-md-auto my-4">
        <form method="POST" action="/biblioteca/prestamos/crear.php">
            <div class="card rounded-top border-dark bg-transparent">
                <div class="card-title bg-naranja p-3 rounded-top mb-0">
                    <h1 class="mb-0"><i class="bi bi-box-arrow-right me-2 fs-1"></i>Crear prestamo</h1>
                </div>
                <div class="card-body bg-white rounded-bottom">
                    <div class="row mb-3">
                        <div class="col">
                            <label for="libro" class="form-label text-black">
                                <i class="bi bi-book me-2"></i>Libro
                            </label>
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
                            <label class="form-label text-black" for="socio">
                                <i class="bi bi-person me-2"></i>Socio
                            </label>
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
                            <label class="form-label" for="fecha_nacimiento">
                                <i class="bi bi-calendar4 me-2"></i>Fecha de inicio
                            </label>
                            <input class="form-control" type="date" name="fechaInicio" default
                                value="<?= date('Y-m-d') ?>">
                        </div>

                    </div>
                    <button type="submit" class="btn mt-3 bg-naranja"><i class="bi bi-save me-2"></i>Guardar</button>
                </div>
            </div>
        </form>
    </div>
</div>