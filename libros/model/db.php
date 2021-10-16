<?php

require_once(__DIR__ . "/../../paginador/paginador.php");
require_once(__DIR__ . "/../../conexion/conexion.php");
require_once(__DIR__ . "/../../error/error.php");

/**
 * Realiza una consulta a la base de datos
 * para obtener todos los resultados posibles
 * que concuerden con los parámetros de la 
 * búsqueda.
 * 
 * @param int $pagina Número de la página actual.
 * @param int $limite Número de elementos por página.
 * @param string $ordenPor Campo por el que se quiere ordenar los elementos.
 * @param string $orden Orden en el que se quieren mostrar los elementos.
 * 
 * @return array Los elementos encontrados.
 */
function librosBuscarTodos($pagina, $limite, $ordenPor, $orden)
{
    try {
        // Montamos la query para realizar la búsqueda.
        // Con esta query, podemos obtener la idAutor,nombre y apellidos de todos los autores de cada libro concatenados en un string en la forma:
        // "id1,nombre1,apellidos1[-id2,nombre2,apellidos2,-.....]
        $query  = "SELECT libros.*,
                        GROUP_CONCAT(autores.idAutor,',', autores.nombre,',', autores.apellidos SEPARATOR '#' ) AS autores
                        FROM libros
                        LEFT JOIN autor_libro ON libros.idLibro = autor_libro.idLibro
                        LEFT JOIN autores ON autores.idAutor = autor_libro.idAutor
                        GROUP BY libros.idLibro";

        // Le agregamos un orden a la búsqueda.
        $query .= sprintf(" ORDER BY %s %s", $ordenPor, $orden);

        // Calculamos el inicio de la página
        $inicio = $limite * ($pagina - 1);

        // Agregamos el límite a la query.
        $query .= sprintf(" LIMIT %d, %d", $inicio, $limite);

        // Enviamos la consulta
        $datos = realizarQuery($query);

        // Si se ha obtenido un resultado
        if ($datos) {

            // Agregamos todos los autores encontrados en el array de libros.
            // mysqli_fetch_all devuelve un array con todas las entradas que ha encontrado con el query.
            // con MYSQLI_ASSOC, hacemos que los índices del array devuelto coincida con los nombres de las tablas de la base de datos.
            $libros = mysqli_fetch_all($datos, MYSQLI_ASSOC);

            // No es la forma más eficiente, pero recogemos el total de elementos en la tabla de libros.
            $query = "SELECT COUNT(libros.idLibro) FROM libros";
            // Realizamos el query.
            $total = realizarQuery($query);

            // Si por un casual falla la query para encontrar el total de elementos en la tabla, le asignamos como valor el número
            // de elementos encontrados.
            if (!$total) {
                $total = count($libros);
            } else {
                // Si no ha fallado, recogemos el resutlado. Puesto que mysqli_fetch_row devuelve un array, recogemos el indice [0] de este.
                $total = mysqli_fetch_row($total)[0];
            }


            // Si queremos recoger los parámetros de los autores como un array, podemos construirlo así.
            foreach ($libros as $key => $libro) {

                // Creamos un array con los autores usando el "-" entre ellos como marca.
                $autores = explode("#", $libro["autores"]);
                $libros[$key]["autores"] = [];

                // Creamos un array de cada autor para obtener la id, el nombre y los apellidos.
                foreach ($autores as $autor) {
                    // Empleamos la "," entre los datos como marca para generar el array con los tres datos.
                    $tmp = explode(",", $autor);

                    // Los autores sin apellido parece que no se leen bien.
                    if (count($tmp) < 2) {
                        // Habría que buscarlo directamente en la base de datos.
                        $autor = null;
                        continue;
                    }

                    // Asignamos la idAutor y el nombre (Reaprovechamos la variable $autor que no vamos a usar más en la iteración.)
                    $autor = [
                        "idAutor" => $tmp[0],
                        "nombre" => $tmp[1]
                    ];
                    // Algunos autores no tiene apellidos, como "Anónomi" por lo que nos aseguramos que lo hay para agregarlo.
                    if (isset($tmp[2])) {
                        $autor["apellidos"] = $tmp[2];
                    }
                    // Agregamos el autor al array de autores del libro.
                    $libros[$key]["autores"][] = $autor;
                }
            }

            // Devolvemos el array de libros.
            return paginar($pagina, $limite, $libros, $total);
        }
    } catch (Exception $e) {
        agregarError("Ha ocurrido un errror: " . $e->getMessage(), "Error inesperado");
    }

    // Se ha producido un error, devolvemos un null.
    return null;
}

/**
 * Busca un libro con la idLibro proporcionada.
 * En caso de no encontrarlo, devuelve null.
 * 
 * @param int $idLibro La id del libro a buscar.
 * 
 * @return array Un array con los datos del libro encontrado.
 */
function librosBuscarUno($idLibro)
{

    try {
        // Establecemos la conexión con la base de datos.
        $conexion = conectarBaseDatos();

        // Si se ha establecido la conexión correctamente.
        if ($conexion) {

            // Con esta query guardamos todos los valores en un mismo array directamente.
            $query  = "SELECT libros.*,
                        GROUP_CONCAT(autores.idAutor,',', autores.nombre,',', autores.apellidos SEPARATOR '-' )AS autores
                        FROM libros
                        LEFT JOIN autor_libro ON libros.idLibro = autor_libro.idLibro
                        LEFT JOIN autores ON autores.idAutor = autor_libro.idAutor
                        WHERE libros.idLibro = " . $idLibro;

            // Enviamos la consulta
            $resultado = realizarQuery($query);

            if ($resultado) {
                // con mysqli_fetch_assoc, hacemos lo mismo que con mysqli_fecth_array, pero la primera nos completa el array con los
                // índices con el nombre de la columna correspondiente, en lugar de con números.
                // ejemplo: $prestamo["idPrestamo"] en lugar de $prstamo[0]
                $resultado = mysqli_fetch_assoc($resultado);

                return $resultado;
            }
        }
    } catch (Exception $e) {
        agregarError("Ha ocurrido un errror: " . $e->getMessage(), "Error inesperado");
    }

    // Se ha producido un error, devolvemos un null.
    return null;
}


/**
 * Inserta un nuevo libro en la tabla de libros.
 * 
 * @param string $titulo El título del libro
 * @param string $editorial La editorial del libro
 * @param int $genero El género del libro
 * @param string $isbn El ISBN del libro.
 * @param int $anhoPublicacion El año de publicación del libro.
 * @param int $fechaAlta Fecha en la que se agrega el libro.
 * @param int[] $autores Array con las idAutor de los autores del libro.
 * 
 * @return mixed El resultado de la operación.
 *      Puede ser:
 *          - Entero (int) en caso de insertarse correctamente.
 *            El entero corresponde a la idLibro asignada al nuevo libro.
 *          - null en caso de fallo
 * 
 * @throws Exception
 */
function librosInsertarNuevo($titulo, $editorial, $genero, $isbn, $anhoPublicacion, $fechaAlta, $autores)
{
    try {

        $query = sprintf(
            "INSERT INTO libros (titulo, editorial, genero, isbn, anhoPublicacion , fechaAlta)
                VALUES ('%s', '%s', '%s', '%s', %d, '%s')",
            $titulo,
            $editorial,
            $genero,
            $isbn,
            $anhoPublicacion,
            $fechaAlta
        );

        // Enviamos la query
        $resultado = realizarQuery($query);

        // Si se ha insertado correctamente, se recibe la id del nuevo libro, por lo tanto, es el turno de asignar los autores.
        if ($resultado) {
            // Si el array de idAutor no está vació, insertamos todos los valores.
            if (!empty($autores)) {
                // Creamos el query.
                $query = "INSERT INTO autor_libro (idAutor, idLibro) VALUES ";
                // Agregamos los valores de cada uno de los autores en la query.

                for ($i = 0; $i < count($autores); $i++) {
                    // $resutlado es la idLibro devuelta al crear el nuevo libro por la base de datos.
                    $query .= sprintf("(%d, %d)", $autores[$i], $resultado);
                    // Si no es el último elemento, agregamos una coma al final
                    if ($i < count($autores) - 1) {
                        $query .= ", ";
                    }
                }

                $resultado = realizarQuery($query);
            }

            return $resultado;
        }
    } catch (Exception $e) {
        agregarError("Ha ocurrido un errror: " . $e->getMessage(), "Error inesperado");
    }
    return false;
}