<div class="row">
    <div class="col-12 justify-content-center">
        <form method="post" action="/biblioteca/socios/editar.php?idSocio=<?= $idSocio ?>" class="w-50 m-auto">

            <div class="mb-3">
                <h3>DNI</h3>
                <input type="text" name="DNI" value="<?= $socio["DNI"] ?>">
            </div>
            <div class="mb-3">
                <h3>Nombre</h3>
                <input type="text" name="nombre" value="<?= $socio["nombre"] ?>">
            </div>
            <div class="mb-3">
                <h3>Apellidos</h3>
                <input type="text" name="apellidos" value="<?= $socio["apellidos"] ?>">
            </div>
            <div class="mb-3">
                <h3>Fecha de nacimiento</h3>
                <input type="date" name="fechaNacimiento" value="<?= $socio["fechaNacimiento"] ?>">
            </div>
            <div class="mb-3">
                <h3>Dirección</h3>
                <input type="text" name="direccion" value="<?= $socio["direccion"] ?>">
            </div>
            <div class="mb-3">
                <h3>Teléfono</h3>
                <input type="number" name="telefono" value="<?= $socio["telefono"] ?>">
            </div>
            <div class="mb-3">
                <h3>E-mail</h3>
                <input type="text" name="email" value="<?= $socio["email"] ?>">
            </div>

            <div class="mb-3">
                <h3>Estado</h3>
                <select class="form-select" aria-label="Estado" name="estado">
                    <option value="0">Seleciona un estado</option>
                    <?php
                    foreach (ESTADOS_SOCIO as $indice => $estado) {
                    ?>
                    <option value="<?= $indice ?>"><?= $estado ?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>
            <input type="hidden" value="<?= $socio["idSocio"] ?>" name="idSocio">
            <input type="submit" class="btn btn-danger" value="Guardar">
        </form>
    </div>
</div>