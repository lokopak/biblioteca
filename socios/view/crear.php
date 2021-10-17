<div class="row">
    <div class="col-12 col-sm-10 col-xl-6 mx-md-auto my-4">
        <form method="post" action="/biblioteca/socios/crear.php">
            <div class="card rounded-top border-dark bg-transparent">
                <div class="card-title bg-naranja p-3 rounded-top mb-0">
                    <h1 class="mb-0"><i class="bi bi-person me-2 fs-1"></i>Agregar socio</h1>
                </div>
                <div class="card-body bg-white rounded-bottom">
                    <div class="row mb-3">
                        <div class="col">
                            <label for="nombre" class="form-label">
                                <i class="bi bi-file-person me-2"></i>Nombre
                            </label for="nombre" class="form-label">
                            <input class="form-control" type="text" name="nombre">
                        </div>
                        <div class="col">
                            <label for="apellidos" class="form-label">
                                <i class="bi bi-file-person me-2"></i>Apellidos
                            </label>
                            <input class="form-control" type="text" name="apellidos">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="direccion" class="form-label">
                                <i class="bi bi-geo-alt me-2"></i>Dirección
                            </label>
                            <input class="form-control" type="text" name="direccion">
                        </div>
                        <div class="col">
                            <label for="DNI" class="form-label">
                                <i class="bi bi-credit-card-2-front me-2"></i>DNI
                            </label>
                            <input class="form-control" type="text" name="DNI">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="fechaNacimiento" class="form-label">
                                <i class="bi bi-calendar me-2"></i>Fecha de nacimiento
                            </label>
                            <input class="form-control" type="date" name="fechaNacimiento">
                        </div>
                        <div class="col">
                            <label for="telefono" class="form-label">
                                <i class="bi bi-telephone me-2"></i>Teléfono
                            </label>
                            <input class="form-control" type="number" name="telefono">
                        </div>
                        <div class="col">
                            <label for="email" class="form-label">
                                <i class="bi bi-at me-2"></i>E-mail
                            </label>
                            <input class="form-control" type="text" name="email">
                        </div>
                    </div>
                    <button type="submit" class="btn mt-3 bg-naranja"><i class="bi bi-save me-2"></i>Guardar</button>
                </div>
            </div>
        </form>
    </div>
</div>