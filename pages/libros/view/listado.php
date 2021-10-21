<div class="row">
    <div class="col-12 my-4">
        <div class="card bg-transparent border-dark">
            <div class="card-header bg-naranja">
                <h1 class="card-title mb-0"><i class="bi bi-vector-pen me-3"></i>Listado de libros</h1>
            </div>
            <div class="card-body bg-white pt-0 px-0">
                <?php
                // Si se ha encontrado algún libro, mostramos la tabla correspondiente.
                if (count($resultado["elementos"]) > 0) {
                ?>
                <div class="row mx-0">
                    <div class="col-12 py-2 px-3 border-top border-bottom bg-naranja borde-naranja">
                        <form method="GET" class="row row-cols-lg-auto gx-3">
                            <div class="col">
                                <label class="visually-hidden" for="limite">Libros por página:</label>
                                <select class="form-select" id="limite" name="limite">
                                    <?php
                                        if ($limite === 10) {
                                            echo '<option value="10" selected>Límite: 10</option>';
                                        } else {
                                            echo '<option value="10">Límite: 10</option>';
                                        }
                                        if ($limite === 20) {
                                            echo '<option value="20" selected>Límite: 20</option>';
                                        } else {
                                            echo '<option value="20">Límite: 20</option>';
                                        }
                                        if ($limite === 50) {
                                            echo '<option value="50" selected>Límite: 50</option>';
                                        } else {
                                            echo '<option value="50">Límite: 50</option>';
                                        }
                                        ?>
                                </select>
                            </div>
                            <div class="col">
                                <label class="visually-hidden" for="ordenPor">Ordenar por:</label>
                                <select class="form-select" id="ordenPor" name="ordenPor">
                                    <?php
                                        if ($ordenPor === 'titulo') {
                                            echo '<option value="titulo" selected>Ordenar por: Título</option>';
                                        } else {
                                            echo '<option value="titulo">Ordenar por: Título</option>';
                                        }
                                        if ($ordenPor === "editorial") {
                                            echo '<option value="editorial" selected>Ordenar por: Editorial</option>';
                                        } else {
                                            echo '<option value="editorial">Ordenar por: Editorial</option>';
                                        }
                                        if ($ordenPor === "genero") {
                                            echo '<option value="genero" selected>Ordenar por: Género</option>';
                                        } else {
                                            echo '<option value="genero">Ordenar por: Género</option>';
                                        }
                                        if ($ordenPor === "ISBN") {
                                            echo '<option value="ISBN" selected>Ordenar por: ISBN</option>';
                                        } else {
                                            echo '<option value="ISBN">Ordenar por: ISBN</option>';
                                        }
                                        if ($ordenPor === "anhoPublicacion") {
                                            echo '<option value="anhoPublicacion" selected>Ordenar por: Año de publicación</option>';
                                        } else {
                                            echo '<option value="anhoPublicacion">Ordenar por: Año de publicación</option>';
                                        }
                                        ?>
                                </select>
                            </div>
                            <div class="col">
                                <label class="visually-hidden" for="orden">Ordenar:</label>
                                <select class="form-select" id="orden" name="orden">
                                    <?php
                                        if ($orden === "ASC") {
                                            echo '<option value="ASC" selected>Ordenar A -> Z</option>';
                                        } else {
                                            echo '<option value="ASC">Ordenar A -> Z</option>';
                                        }
                                        if ($orden === "DESC") {
                                            echo '<option value="DESC" selected>Ordenar Z -> A</option>';
                                        } else {
                                            echo '<option value="DESC">Ordenar Z -> A</option>';
                                        }
                                        ?>
                                </select>
                            </div>
                            <div class="col">
                                <button type="submit" class="btn btn-verde">
                                    <i class="bi bi-arrow-clockwise me-2"></i>Actualizar
                                </button>
                            </div>

                            <div class="col ms-auto me-5">
                                <a class="btn btn-verde" href="/biblioteca/libros/crear.php">
                                    <i class="bi bi-plus-circle me-2"></i>
                                    Nuevo libro
                                </a>

                            </div>
                        </form>
                    </div>
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col" class="text-center">#</th>
                            <th scope="col">Título</th>
                            <th scope="col">Autor(es)</th>
                            <th scope="col">Editorial</th>
                            <th scope="col">Género</th>
                            <th scope="col">ISBN</th>
                            <th scope="col">Año edición</th>
                            <th scope="col" class="text-center">Estado</th>
                            <th scope="col">Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach ($resultado["elementos"] as $libro) {
                                // Damos color a los estados.
                                switch ($libro["estado"]) {
                                    case LIBRO_ESTADO_NO_DISPONIBLE:
                                        $estado = "secondary";
                                        break;
                                    case LIBRO_ESTADO_DISPONIBLE:
                                        $estado = "success";
                                        break;
                                    case LIBRO_ESTADO_DETERIORADO:
                                        $estado = "warning";
                                        break;
                                    case LIBRO_ESTADO_PRESTADO:
                                        $estado = "danger";
                                        break;
                                }
                            ?>
                        <tr>
                            <th scope="row" class="text-center align-middle"><?php echo $libro["idLibro"] ?></th>
                            <td class="align-middle"><a class="text-decoration-none"
                                    href="/biblioteca/libros/mostrar.php?idLibro=<?= $libro['idLibro'] ?>"><?= $libro["titulo"] ?></a>
                            </td>
                            <td class="align-middle">
                                <?php
                                        $autores = "";
                                        foreach ($libro["autores"] as $key => $autor) {
                                            $autores .= '<a class="text-decoration-none"
                                    href="/biblioteca/autores/mostrar.php?idAutor=' . $autor['idAutor'] . '">' . $autor["nombre"];
                                            if (isset($autor["apellidos"])) {
                                                $autores .= " " . $autor["apellidos"];
                                            }
                                            $autores .= "</a>";
                                            if ($key >= 0 && $key < count($libro["autores"]) - 1) {
                                                $autores .= "<br/>";
                                            }
                                        }

                                        echo $autores;
                                        ?>
                            </td>
                            <td class="align-middle"><?= $libro["editorial"] ?></td>
                            <td class="align-middle"><?= $libro["genero"] ?></td>
                            <td class="align-middle"><?= $libro["isbn"] ?></td>
                            <td class="align-middle"><?= $libro["anhoPublicacion"] ?></td>
                            <td class="align-middle text-center">
                                <?php if (isset($estado)) { ?>
                                <span
                                    class="ms-2 badge rounded-pill bg-<?= $estado ?>"><?= LIBRO_ESTADOS[$libro['estado']] ?></span>
                                <?php } ?>
                            </td>
                            <td class="align-middle">
                                <a href="/biblioteca/libros/editar.php?idLibro=<?= $libro["idLibro"] ?>"
                                    class="btn btn-outline-secondary btn-sm amarillo"><i class="bi bi-pencil"></i></a>
                            </td>
                        </tr>

                        <?php
                            }
                            ?>
                    </tbody>
                </table>

            </div>

        </div>

        <?php

                    // Si se indica página o límite, mostramos el paginador.
                    if ($pagina !== null) {
                        // Cargamos el archivo necesario para manejar la tabla de autores.
                        require_once(__DIR__ . "/../../paginador/paginador.php");
        ?>
        <div class="row">
            <div class="col my-3">
                <?php mostrarPaginador("libros", $resultado); ?>
            </div>
        </div>
        <?php
                    }

                    // En caso de que no se haya encontrado algún libro, mostramos un mensaje advirtiéndolo en lugar de la tabla.
                } else {
                    echo '<p class="py-2">No se ha encontrado ningún libro</p>';
                }
    ?>
    </div>
</div>

<?php
// Mostramos el footer de la página.
require_once(__DIR__ . "/../../view/footer.php");
?>