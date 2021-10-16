<div class="row">
    <div class="col px-2 py-2">
        <form class="form" method="POST" action="/biblioteca/libros/crear.php">
            <h1 class="m-2">Agregar nuevo libro<input type="submit" class="btn btn-primary m-2" value="Guardar">
            </h1>
            <div class="border-top border-bottom">
                <!--titulo-->
                <div class="form-group">
                    <div class="row">
                        <div class="col-auto">
                            <i class="bi bi-bookmark-check" style="font-size: 3rem;"></i>
                        </div>
                        <div class="col-5">
                            <input name="titulo" type="text" placeholder="Título del libro"
                                class="form-control m-3 shadow bg-body rounded">
                        </div>
                    </div>
                </div>
                <!--autor-->
                <div class="form-group">
                    <div class="row">
                        <label class="col-auto">
                            <i class="bi bi-file-person" style="font-size: 3rem;"></i>
                        </label>
                        <div class="col-5">
                            <select class="form-select m-3 shadow bg-body rounded" multiple placeholder="Autor"
                                aria-label="multiple select example" name="autores[]">
                                <option value="0" selected>Autor</option>
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
                </div>
                <!--editorial-->
                <div class="form-group">
                    <div class="row">
                        <dov class="col-auto">
                            <i class="bi bi-bookmark-heart" style="font-size: 3rem;"></i>
                        </dov>
                        <div class="col-5">
                            <input name="editorial" type="text" placeholder="Editorial"
                                class="form-control m-3  shadow bg-body rounded">
                        </div>
                    </div>
                </div>
                <!--genero-->
                <div class="form-group">
                    <div class="row">
                        <div class="col-auto">
                            <i class="bi bi-emoji-smile" style="font-size: 3rem;"></i>
                        </div>
                        <div class="col-5">
                            <select class="form-select m-3 shadow bg-body rounded" aria-label="Default select example"
                                name="genero">
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
                    </div>
                </div>
                <!--isbn-->
                <div class="form-group">
                    <div class="row">
                        <div class="col-auto">
                            <i class="bi bi-file-earmark-word" style="font-size: 3rem;"></i>
                        </div>
                        <div class="col-5">
                            <input name="isbn" type="text" placeholder="ISBN"
                                class="form-control m-3 shadow bg-body rounded">
                        </div>
                    </div>
                </div>
                <!--año edicion-->
                <div class="form-group">
                    <div class="row">
                        <div class="col-auto">
                            <i class="bi bi-clock" style="font-size: 3rem;"></i>
                        </div>
                        <div class="col-5">
                            <input name="anhoPublicacion" min="1000" max="2999" type="number"
                                placeholder="Año de publicación" class="form-control m-3  shadow bg-body rounded">
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>