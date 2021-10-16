<?php
// Mostramos el contenido html del head de la página
require(__DIR__ . "/../../view/head.php");

?>

<div class="row">
    <div class="col-12 my-4 px-4 justify-content-center">
        <h1>Listado de libros</h1>
        <?php

        // Si se ha encontrado algún libro, mostramos la tabla correspondiente.
        if (count($resultado) > 0) {
        ?>
        <div class="row mb-3">
            <div class="col-12 py-2 border-top border-bottom">
                <form method="GET" class="row row-cols-lg-auto g-3 align-items-center">
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
                        <button type="submit" class="btn btn-primary">Actualizar</button>
                    </div>

                    <div class="col ms-auto me-5">
                        <a type="button " class="btn btn-success" href="/biblioteca/libros/crear.php">
                            <i class="bi bi-plus-circle me-2"></i>
                            Agregar nuevo libro
                        </a>

                    </div>
                </form>
            </div>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Título</th>
                    <th scope="col">Autor(es)</th>
                    <th scope="col">Editorial</th>
                    <th scope="col">Género</th>
                    <th scope="col">ISBN</th>
                    <th scope="col">Año edición</th>
                    <th scope="col">Acción</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                    foreach ($resultado["elementos"] as $libro) {
                    ?>
                <tr>
                    <th scope="row"><?php echo $libro["idLibro"] ?></th>
                    <td><a class="text-decoration-none"
                            href="/biblioteca/libros/mostrar.php?idLibro=<?= $libro['idLibro'] ?>"><?= $libro["titulo"] ?></a>
                    </td>
                    <td>
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
                    <td><?= $libro["editorial"] ?></td>
                    <td><?= $libro["genero"] ?></td>
                    <td><?= $libro["isbn"] ?></td>
                    <td><?= $libro["anhoPublicacion"] ?></td>
                    <td>
                        <a href="/biblioteca/libros/editar.php?idLibro=<?= $libro["idLibro"] ?>"
                            class="btn btn-outline-secondary btn-sm"><i class="bi bi-pencil fs-6"></i></a>
                    </td>
                </tr>

                <?php
                    }
                    ?>
                </tb+ody>
        </table>

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
require(__DIR__ . "/../../view/footer.php");
?>