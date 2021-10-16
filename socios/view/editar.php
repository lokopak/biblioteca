<div class="row">
    <div class="col-12 justify-content-center">
        <form method="post" action="/biblioteca/socios/editar.php?idSocio=<?= $idSocio ?>" class="w-50 m-auto">

            <h3>DNI</h3>
            <input type="text" name="DNI" value="<?= $socio["DNI"] ?>">
            <h3>Nombre</h3>
            <input type="text" name="nombre" value="<?= $socio["nombre"] ?>">
            <h3>Apellidos</h3>
            <input type="text" name="apellidos" value="<?= $socio["apellidos"] ?>">
            <h3>Fecha de nacimiento</h3>
            <input type="date" name="fechaNacimiento" value="<?= $socio["fechaNacimiento"] ?>">
            <h3>Dirección</h3>
            <input type="text" name="direccion" value="<?= $socio["direccion"] ?>">
            <h3>Teléfono</h3>
            <input type="number" name="telefono" value="<?= $socio["telefono"] ?>">
            <h3>E-mail</h3>
            <input type="text" name="email" value="<?= $socio["email"] ?>">

            <div class="mb-3">
                <h3>Estado</h3>
                <select class="form-select" aria-label="Estado" name="estado" value="<?= $socio["estado"] ?>">
                    <option selected>Seleciona un estado</option>
                    <option value="0"><?= $estadosSocio[0] ?></option>
                    <option value="1"><?php echo $estadosSocio[1] ?></option>
                    <option value="2"><?= $estadosSocio[2] ?></option>
                    <option value="3"><?= $estadosSocio[3] ?></option>
                    <option value="4"><?= $estadosSocio[4] ?></option>
                </select>
            </div>
            <input type="hidden" value="<?= $socio["idSocio"] ?>" name="idSocio">
            <input type="submit" class="btn btn-danger" value="Guardar">
        </form>
    </div>
</div>