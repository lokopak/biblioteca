<div class="row">
    <div class="col-12 col-sm-10 col-xl-6 mx-md-auto my-4">
        <form method="post" action="/biblioteca/autores/editar.php?idAutor=<?= $idAutor ?>">
            <div class="card rounded-top border-dark bg-transparent">
                <div class="card-title bg-naranja p-3 rounded-top mb-0">
                    <h1 class="mb-0"><i class="bi bi-vector-pen me-2 fs-1"></i>Editar autor</h1>
                </div>

                <div class="card-body bg-white rounded-bottom">
                    <div class="row mb-3">
                        <div class="col">
                            <label for="nombre" class="form-label">
                                <i class="bi bi-file-person me-2"></i>Nombre
                            </label>
                            <input class="form-control" type="text" name="nombre" value="<?= $autor['nombre'] ?>">
                        </div>
                        <div class="col">
                            <label for="apellidos" class="form-label">
                                <i class="bi bi-file-person me-2"></i>Apellidos
                            </label>
                            <input class="form-control" type="text" name="apellidos" value="<?= $autor['apellidos'] ?>">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="nacionalidad" class="form-label">
                                <i class="bi bi-globe2 me-2"></i>Nacionalidad
                            </label>
                            <input class="form-control" type="text" name="nacionalidad"
                                value="<?= $autor['nacionalidad'] ?>">
                        </div>
                        <div class="col">
                            <label for="fechaNacimiento" class="form-label">
                                <i class="bi bi-calendar me-2"></i>Fecha de nacimiento
                            </label>
                            <input class="form-control" type="date" name="fechaNacimiento"
                                value="<?= $autor['fechaNacimiento'] ?>">
                        </div>
                    </div>
                    <button type="submit" class="btn mt-3 bg-naranja"><i class="bi bi-save me-2"></i>Guardar</button>
                    <input type="hidden" name="idAutor" value="<?= $autor["idAutor"] ?>>
                </div>
            </div>
        </form>
    </div>
</div>