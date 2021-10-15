<?php
// Cargamos el archivo necesario para gestionar la conexión con la base de datos.
require_once(__DIR__ . "/../../conexion/conexion.php");
// Cargamos el archivo necesario para paginar los elementos encontrados.
require_once(__DIR__ . "/../../paginador/paginador.php");

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
 * @param int $estado Estado en el que se encuentran los elementos que se quieren buscar.
 * 
 * @return mixed
 * 
 * @throws
 */
function sociosBuscarTodos($pagina, $limite, $ordenPor, $orden, $estado)
{

    try {
        // Establecemos la conexión con la base de datos.
        $conexion = conectarBaseDatos();

        // Si se ha establecido la conexión correctamente.
        if ($conexion) {
            // Montamos la query para realizar la búsqueda.
            $query = "SELECT * FROM socios";

            // Le agregamos un orden a la búsqueda.
            $query .= sprintf(" ORDER BY %s %s", $ordenPor, $orden);
            // En el caso de ordenar por apellidos, le agregamos también que lo ordene por nombre
            if ($ordenPor === "apellidos") {
                $query .= sprintf(", nombre %s", $orden);
            } else if ($ordenPor === "nombre") {
                // En el caso de ordenar por nombre, le agregamos también que lo ordene por apellidos
                $query .= sprintf(", apellidos %s", $orden);
            }

            // Agregamos el límite para el paginador.
            if (isset($inicio) && isset($pagina)) {
                // Calculamos el inicio de la página
                $inicio = $limite * ($pagina - 1);

                // Agregamos el límite a la query.
                $query .= sprintf(" LIMIT %d, %d", $inicio, $limite);
            }

            // Enviamos la consulta
            $resultado = realizarQuery($query);

            // Si se ha obtenido un resultado
            if ($resultado) {
                $socios = [];

                // No es la forma más eficiente, pero recogemos el total de elementos en la tabla de libros.
                // Indicamos que sólo escoja la id para minimizar el tiempo de ejecución de la query.
                $query = "SELECT COUNT(socios.idSocio) FROM socios";
                // Realizamos el query.
                $total = realizarQuery($query);

                // Agregamos todos los autores encontrados en el array de libros.
                // mysqli_fetch_all devuelve un array con todas las entradas que ha encontrado con el query.
                $socios = mysqli_fetch_all($resultado, MYSQLI_ASSOC);

                // Si por un casual falla la query para encontrar el total de elementos en la tabla, le asignamos como valor el número
                // de elementos encontrados.
                if (!$total) {
                    $total = count($socios);
                } else {
                    // Si no ha fallado, recogemos el resutlado. Puesto que mysqli_fetch_row devuelve un array, recogemos el indice [0] de este.
                    $total = (int) mysqli_fetch_row($total)[0];
                }

                // Devolvemos el array de autores.
                return paginar($pagina, $limite, $socios, $total);
            }
        }
    } catch (Exception $e) {
        agregarError("Ha ocurrido un errror: " . $e->getMessage(), "Error inesperado");
    }

    // Se ha producido un error, devolvemos un null.
    return null;
}

/**
 * Busca un socio con la idSocio proporcionada.
 * En caso de no encontrarlo, devuelve null.
 */
function sociosBuscarUno($idSocio)
{

    try {
        // Establecemos la conexión con la base de datos.
        $conexion = conectarBaseDatos();

        // Si se ha establecido la conexión correctamente.
        if ($conexion) {

            // Con esta query guardamos todos los valores en un mismo array directamente.
            $query = "SELECT socios.*
            FROM socios
            WHERE socios.idSocio = " . $idSocio;

            // Enviamos la consulta
            $resultado = realizarQuery($query);

            if ($resultado) {
                // con mysqli_fetch_assoc, hacemos lo mismo que con mysqli_fecth_array, pero la primera nos completa el array con los
                // índices con el nombre de la columna correspondiente, en lugar de con números.
                // ejemplo: $socio["idSocio"] en lugar de $socio[0]
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