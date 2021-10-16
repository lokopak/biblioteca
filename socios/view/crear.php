<div class="row">
    <div class="col-12 justify-content-center">
        <form method="post" action="/biblioteca/socios/crear.php" class="w-50 m-auto">

            <div class="mb-3">
                <h3>DNI</h3>
                <input type="text" name="DNI">
            </div>
            <div class="mb-3">
                <h3>Nombre</h3>
                <input type="text" name="nombre">
            </div>
            <div class="mb-3">
                <h3>Apellidos</h3>
                <input type="text" name="apellidos">
            </div>
            <div class="mb-3">
                <h3>Fecha de nacimiento</h3>
                <input type="date" name="fechaNacimiento">
            </div>
            <div class="mb-3">
                <h3>Dirección</h3>
                <input type="text" name="direccion">
            </div>
            <div class="mb-3">
                <h3>Teléfono</h3>
                <input type="number" name="telefono">
            </div>
            <div class="mb-3">
                <h3>E-mail</h3>
                <input type="text" name="email">
            </div>

            <input type="submit" class="btn btn-danger" value="Guardar">
        </form>
    </div>
</div>