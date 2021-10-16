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
        // Montamos la query para realizar la búsqueda.
        $query = "SELECT * FROM socios";

        $query .= sprintf(" WHERE socios.estado = %d", $estado);

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
        if (isset($limite) && isset($pagina)) {
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

            // Agregamos todos los socioes encontrados en el array de libros.
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

            // Devolvemos el array de socioes.
            return paginar($pagina, $limite, $socios, $total);
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
 * 
 * @param int $idSocio La id del socio a buscar
 */
function sociosBuscarUno($idSocio)
{
    try {

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
    } catch (Exception $e) {
        agregarError("Ha ocurrido un errror: " . $e->getMessage(), "Error inesperado");
    }

    // Se ha producido un error, devolvemos un null.
    return null;
}

/**
 * Actualiza un socio con los nuevos datos
 * recividos.
 * 
 * @param $nombre El nuevo nombre del socio
 * @param $apellidos Los nuevos apellidos del socio
 * @param $direccion La nueva direccion del socio
 * @param $fechaNacimiento La nueva fecha de nacimiento del socio.
 * @param $idSocio La id correspondiente al socio que se desea actualizar.
 * 
 * @return boolean El resultado de la operación
 * 
 * @throws Exception 
 */
function sociosActualizar($nombre, $apellidos, $direccion, $fechaNacimiento, $DNI, $telefono, $email, $estado, $idSocio)
{
    try {

        $query = sprintf(
            "UPDATE socios SET
            DNI = '%s',
            nombre = '%s',
            apellidos = '%s',
            direccion = '%s',
            fechaNacimiento = '%s',
            telefono = '%s',
            email = '%s',
            estado = %d
            WHERE idSocio = %d",
            $DNI,
            $nombre,
            $apellidos,
            $direccion,
            $fechaNacimiento,
            $telefono,
            $email,
            $estado,
            $idSocio
        );
        // Enviamos la query
        $resultado = realizarQuery($query);

        // Si se ha obtenido un resultado
        if ($resultado) {
            return $resultado;
        }
    } catch (Exception $e) {
        agregarError("Ha ocurrido un errror: " . $e->getMessage(), "Error inesperado");
    }
    return false;
}