<div class="row">
    <div class="col-12 justify-content-center">
        <h3>Nombre</h3>
        <input type="text" name="nombre" value="<?= $autor['nombre'] ?>">
        <h3>Apellidos</h3>
        <input type="text" name="apellidos" value="<?= $autor['apellidos'] ?>">
        <h3>Nacionalidad</h3>
        <input type="text" name="nacionalidad" value="<?= $autor['nacionalidad'] ?>">
        <h3>Fecha de nacimiento</h3>
        <input type="date" name="fechaNacimiento" value="<?= $autor['fechaNacimiento'] ?>">
        <input type="submit" class="btn btn-danger" value="Guardar">
    </div>
</div>