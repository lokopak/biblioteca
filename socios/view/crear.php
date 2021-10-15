<div class="row">
    <div class="col my-4 px-4">
        <form class="form" method="POST" action="/biblioteca/libros/crear.php">
            <div class="row md-3">
                <div class="col-12 d-flex py-2 align-content-center">
                    <h1 class="d-inline align-self-center">Agregar nuevo libro</h1><input type="submit"
                        class="btn btn-primary ms-3 align-self-center" value="Guardar">
                </div>
                <div class="col-12 py-2 border-top border-bottom">
                    <fielset>
                        <div class="form-group">
                            <!--titulo-->
                            <span class="col-md-1 col-md-offset-2">
                                <i class="bi bi-bookmark-check" style="font-size: 2rem;"></i></span>
                            <div class="col-md-3">
                                <input name="titulo" type="text" placeholder="Título del libro" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <!--autor-->
                            <span class="col-md-1 col-md-offset-2 text-center"><i class="bi bi-file-person"
                                    style="font-size: 2rem;"></i></span>
                            <label for="autores[]" class="form-label">Autores</label>
                            <div class="col-md-3">
                                <select class="form-select" multiple placeholder="Autores"
                                    aria-label="Default select example" name="autores[]">
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
                            </div>
                        </div>
                        <div class="form-group">
                            <!--editorial-->
                            <span class="col-md-1 col-md-offset-2 text-center"><i class="bi bi-bookmark-heart"
                                    style="font-size: 2rem;"></i></span>
                            <div class="col-md-3">
                                <input name="editorial" type="text" placeholder="Editorial" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <!--genero-->
                            <span class="col-md-1 col-md-offset-2 text-center"><i class="bi bi-emoji-smile"
                                    style="font-size: 2rem;"></i></span>
                            <div class="col-md-3">
                                <select class="form-select " aria-label="Default select example" name="genero">
                                    <option value="0" selected>Género</option>
                                    <?php
                                    // Mostramos el lisado de géneros.
                                    foreach (GENEROS_LITERARIOS as $key => $genero) {
                                    ?>
                                    <option value="<?= $key ?>"><?= $genero ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <!--isbn-->
                            <span class="col-md-1 col-md-offset-2 text-center"><i class="bi bi-file-earmark-word"
                                    style="font-size: 2rem;"></i></span>
                            <div class="col-md-3">
                                <input name="isbn" type="text" placeholder="ISBN" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <!--año edicion-->
                            <span class="col-md-1 col-md-offset-2 text-center"><i class="bi bi-clock"
                                    style="font-size: 2rem;"></i></span>
                            <div class="col-md-3">
                                <input name="anho_publicacion" min="1000" max="2999" type="number"
                                    placeholder="Año de publicación" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <!--fecha de alta-->
                            <span class="col-md-1 col-md-offset-2 text-center"><i class="bi bi-calendar-check"
                                    style="font-size: 2rem;"></i></span>
                            <div class="col-md-3">
                                <input class="form-control" name="fechaAlta" type="datetime"
                                    placeholder="Fecha de alta (YYYY-MM-DD)" value="<?php echo date("Y-m-d"); ?>">
                            </div>
                        </div>
                    </fielset>
                </div>
            </div>
        </form>
    </div>
</div>
</div>
</div>