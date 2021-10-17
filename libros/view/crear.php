<div class="row">
    <div class="col-12 col-sm-10 col-xl-6 mx-md-auto my-4">
        <form method="post" action="/biblioteca/libros/crear.php">
            <div class="card rounded-top border-dark bg-transparent">
                <div class="card-title bg-naranja p-3 rounded-top mb-0">
                    <h1 class="mb-0"><i class="bi bi-book me-2 fs-1"></i>Agregar nuevo libro</h1>
                </div>
                <div class="card-body bg-white rounded-bottom">
                    <div class="row mb-3">
                        <div class="col-12 col-lg-7">
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="titulo" class="form-label">
                                        <i class="bi bi-bookmark-check me-2"></i>Títuo
                                    </label>
                                    <input name="titulo" type="text" placeholder="Título del libro"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="editorial" class="form-label">
                                        <i class="bi bi-bookmark-heart me-2"></i>Editorial
                                    </label>
                                    <input name="editorial" type="text" placeholder="Editorial" class="form-control">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <!--genero-->
                                <div class="col">
                                    <label for="genero" class="form-label">
                                        <i class="bi bi-emoji-smile me-2"></i>Género
                                    </label>
                                    <select class="form-select" aria-label="Género" name="genero">
                                        <option value="0" selected>Género</option>
                                        <?php
                                        foreach (GENEROS_LITERARIOS as $indice => $nombre) {
                                        ?>
                                        <option value="<?= $indice ?>"><?= $nombre ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <!--año edicion-->
                                <div class="col">
                                    <label for="anhoPublicacion" class="form-label">
                                        <i class="bi bi-clock me-2"></i>Año de edición
                                    </label>
                                    <input name="anhoPublicacion" min="1000" max="2999" type="number"
                                        placeholder="Año de publicación" class="form-control">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <!--isbn-->
                                    <label for="isbn" class="form-label">
                                        <i class="bi bi-file-earmark-word me-2"></i>ISBN
                                    </label>
                                    <input name="isbn" type="text" placeholder="ISBN" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-5">
                            <div class="row">
                                <div class="col">
                                    <label for="autores" class="form-label">
                                        <i class="bi bi-file-person me-2"></i>Autores
                                    </label>
                                    <select class="form-select" multiple placeholder="Autores" size="14"
                                        aria-label="Autores" name="autores[]">
                                        <?php
                                        foreach ($autores as $autor) {
                                            $nombreAutor = $autor['nombre'];
                                            if (isset($autor['apellidos'])) {
                                                $nombreAutor .= " " . $autor['apellidos'];
                                            }
                                            echo '<option value="' . $autor['idAutor'] . '">' . $nombreAutor . '</option>';
                                        }
                                        ?>
                                    </select>
                                    <span class="text-muted" style="font-size: .75rem;">* Mantén pulsada la tecla Ctrl
                                        para
                                        seleccionar a más
                                        de un
                                        autor</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn mt-3 bg-naranja"><i class="bi bi-save me-2"></i>Guardar</button>
                </div>
            </div>
        </form>
    </div>
</div>