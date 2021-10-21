<?php
// require_once es igual que 'import' con la diferencia de que si el archivo
// no se encuentra, se devuelve un error grave y se asegura que el archivo se carga
// en la memoria una sola vez. Esto sirve para no duplicar un código que queremos
// que solo se carge una vez.

// Cargamos el contenido del archivo conexion.php (si no ha sido cargado anteriormente)
require_once(__DIR__ . "/../../conexion/conexion.php");
// Cargamos el archivo necesario para paginar los elementos encontrados.
require_once(__DIR__ . "/../../paginador/paginador.php");

/**
 * Revisa todos los préstamos listados y comprueba si se encuentran fuera de plazao.
 * De ser así, actualiza su estado.
 * 
 * @param array &$prestamos Los préstamos a revisar.
 *              NOTA: El símbolo & delate del nombre del parámetro, nos permite modificarla
 *                    dentro del cuerpo de la función directamente.
 * 
 * @return boolean Indica si se ha encontrado algún préstamo fuera de plazo
 */
function comprobarFueraDePlazo(&$prestamos)
{
    // Almacenaremos aquí todas las ids de los préstamos que estén fuera de plazo.
    $fueraDePlazo = [];
    foreach ($prestamos as $key => $prestamo) {
        // Sólo nos interesan los préstamos que aún estén activos.
        if ((int)$prestamo["estado"] !== PRESTAMO_ESTADO_ACTIVO) {
            continue;
        }
        // Si etá fuera de plazo.
        if (strtotime(date("Y-m-d", time())) > strtotime($prestamo["fechaDevolucion"])) {
            // Agregamos la idPrestamo al array
            $fueraDePlazo[] = $prestamo["idPrestamo"];
            // Y actualizamos el estado para que el cambio se pueda ver ya en la siguiente impresión
            $prestamos[$key]["estado"] = PRESTAMO_ESTADO_FUERA_PLAZO;
        }
    }

    // Si nos hemos encontrado alguno fuera de plazo.
    if (count($fueraDePlazo) > 0) {
        // Convertimos el array en una cadena de strings en la que los elementos están separados por comas.
        // [1, 2, 3, 4] => "1,2,3,4"
        // Esto es obligatorio para poder usarlo en el IN de la query.
        $idPrestamos = implode(",", $fueraDePlazo);
        $query = sprintf("UPDATE prestamos SET estado = %d WHERE idPrestamo IN(%s)", PRESTAMO_ESTADO_FUERA_PLAZO, $idPrestamos);

        return realizarQuery($query);
    }

    // De lo contrario, devolvemos false.
    return false;
}

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
 * @return array Un array con todos los préstamos encontrados.
 */
function prestamoBuscarTodos($pagina, $limite, $ordenPor, $orden, $estado)
{
    // Metemos todo la ejecución de la consulta a la base de datos
    // dentro de un bloque try-catch para poder manejar cualquier
    // fallo o excepción que se produzca durante la ejecución de las consultas
    // necesarias.
    try {
        // Establecemos la conexión con la base de datos.
        $conexion = conectarBaseDatos();

        // Si se ha establecido la conexión correctamente.
        if ($conexion) {
            $prestamos = [];

            // Montamos el string de la query para realizar la búsqueda.
            $query = "SELECT prestamos.*, socios.idSocio, socios.nombre, socios.apellidos, libros.titulo, libros.idLibro
                        FROM prestamos
                        LEFT JOIN socios ON socios.idSocio = prestamos.idSocio
                        LEFT JOIN libros ON libros.idLibro = prestamos.idLibro";

            // Le agregamos un orden a la búsqueda.
            $query .= sprintf(" ORDER BY %s %s", $ordenPor, $orden);
            // En el caso de ordenar por apellidos, le agregamos también que lo ordene por nombre
            if ($ordenPor === "apellidos") {
                $query .= sprintf(", socios.nombre %s", $orden);
            } else if ($ordenPor === "nombre") {
                // En el caso de ordenar por nombre, le agregamos también que lo ordene por apellidos
                $query .= sprintf(", socios.apellidos %s", $orden);
            }

            if ($estado !== null) {
                $query .= sprintf(" WHERE prestamos.estado = %d", $estado);
            }

            // Calculamos el inicio de la página
            $inicio = $limite * ($pagina - 1);

            // Agregamos el límite a la query.
            $query .= sprintf(" LIMIT %d, %d", $inicio, $limite);

            // Enviamos la consulta
            $resultado = realizarQuery($query);

            if ($resultado) {

                // No es la forma más eficiente, pero recogemos el total de elementos en la tabla de libros.
                // Indicamos que sólo escoja la id para minimizar el tiempo de ejecución de la query.
                $query = "SELECT COUNT(autores.idAutor) FROM autores WHERE nombre NOT LIKE '%Anónimo%'";
                // Realizamos el query.
                $total = realizarQuery($query);

                // Si se ha obtenido un resultado
                // Agregamos todos los autores encontrados en el array de libros.
                // mysqli_fetch_all devuelve un array con todas las entradas que ha encontrado con el query.
                $prestamos = mysqli_fetch_all($resultado, MYSQLI_ASSOC);

                // Si por un casual falla la query para encontrar el total de elementos en la tabla, le asignamos como valor el número
                // de elementos encontrados.
                if (!$total) {
                    $total = count($prestamos);
                } else {
                    // Si no ha fallado, recogemos el resutlado. Puesto que mysqli_fetch_row devuelve un array, recogemos el indice [0] de este.
                    $total = (int) mysqli_fetch_row($total)[0];
                }

                // Aprovechamos que se van a imprimir los préstamos para comprobar que están fuera de plazo  y actualizar la base de datos?
                comprobarFueraDePlazo($prestamos);

                // Devolvemos el array de autores.
                return paginar($pagina, $limite, $prestamos, $total);
            }
        }
    } catch (Exception $e) {
        // Agregamos el mensaje de error a la lista de errores.
        agregarError("Ha ocurrido un error: " . $e->getMessage(), "Error inesperado");
    }

    // Se ha producido un error, devolvemos un null.
    return null;
}

/**
 * Busca un préstamo con la idPrestamo proporcionada.
 * En caso de no encontrarlo, devuelve null.
 * 
 * @param int $idPrestamo La id del préstamo que queremos buscar.
 * 
 * @return 
 */
function prestamosBuscarUno($idPrestamo)
{

    try {
        // Establecemos la conexión con la base de datos.
        $conexion = conectarBaseDatos();

        // Si se ha establecido la conexión correctamente.
        if ($conexion) {

            // Con esta query guardamos todos los valores en un mismo array directamente.
            $query = "SELECT prestamos.*, libros.idLibro, libros.titulo, socios.idSocio, socios.nombre, socios.apellidos
            FROM prestamos
            LEFT JOIN libros ON libros.idLibro = prestamos.idLibro
            LEFT JOIN socios ON socios.idSocio = prestamos.idSocio
            WHERE prestamos.idPrestamo = " . $idPrestamo;

            // Enviamos la consulta
            $resultado = realizarQuery($query);

            if ($resultado) {

                // Cuando una consulta a la base de datos falla, envía un valor null o un false dependiendo del tipo de consulta.
                // Por tanto, si eso pasa, mostramos el error en el html.
                if ($resultado === null || $resultado === false) {
                    agregarError(
                        "Se ha producido un error durante la realización de la consulta:<br/>
                    " . mysqli_error($conexion),
                        "Error en SQL"
                    );
                    return null;
                }

                // con mysqli_fetch_assoc, hacemos lo mismo que con mysqli_fecth_array, pero la primera nos completa el array con los
                // índices con el nombre de la columna correspondiente, en lugar de con números.
                // ejemplo: $prestamo["idPrestamo"] en lugar de $prstamo[0]
                $resultado = mysqli_fetch_assoc($resultado);

                return $resultado;
            }
        }
    } catch (Exception $e) {
        // Algo malo ha pasado, mostramos el mensaje
        agregarError("Ha ocurrido un errror: " . $e->getMessage(), "Error inesperado");
    }

    // Se ha producido un error, devolvemos un null.
    return null;
}

/**
 * Esta función inserta un nuevo prestamo en la base de datos
 * con los datos proporcionados.
 * 
 * @param array $prestamo Un array con todos los datos del préstamo
 * 
 * @return mixed Devuelve el resutlado de la ejecución de la consulta.
 */
function prestamosInsertar($prestamo)
{
    // La función sprintf("...", ...) devuelve un string formateado agregando los valores indicados en las posiciones correspondientes.
    // Es más seguro, fiable y manejable que usar concatenaciones de strings.
    $query = sprintf(
        "INSERT INTO prestamos
                              (idLibro,idSocio,fechaInicio,fechaDevolucion, estado)
                              VALUES (%d, %d, '%s', '%s', %d)",
        $prestamo['idLibro'],
        $prestamo['idSocio'],
        $prestamo['fechaInicio'],
        $prestamo['fechaDevolucion'],
        $prestamo['estado']
    );

    // Devolvemos el resultado de realizar la consulta en la base de datos.
    return realizarQuery($query);
}

/**
 * Esta función actualiza un prestamo en la base de datos
 * con los datos proporcionados.
 * 
 * @param array $prestamo Un array con todos los datos del préstamo
 * 
 * @return mixed Devuelve el resutlado de la ejecución de la consulta.
 */
function prestamosActualizar($prestamo)
{
    // La función sprintf("...", ...) devuelve un string formateado agregando los valores indicados en las posiciones correspondientes.
    // Es más seguro, fiable y manejable que usar concatenaciones de strings.
    $query = sprintf(
        "UPDATE prestamos
                    SET idLibro = %d, idSocio = %d, fechaInicio = '%s', fechaDevolucion = '%s', estado = %d
                    WHERE idPrestamo = %d",
        $prestamo['idLibro'],
        $prestamo['idSocio'],
        $prestamo['fechaInicio'],
        $prestamo['fechaDevolucion'],
        $prestamo['estado'],
        $prestamo['idPrestamo']
    );

    // Devolvemos el resultado de realizar la consulta en la base de datos.
    return realizarQuery($query);
}

/**
 * Permite actualizar directamente en estado de un préstamo
 * directamente.
 * 
 * @param int $idPrestamo La id del préstamo a actualizar.
 * @param int $estado El nuevo estado del préstamo.
 * 
 * @return boolean El resultado de la operación.
 */
function prestamosActualizarEstado($idPrestamo, $estado)
{
    try {
        // La función sprintf("...", ...) devuelve un string formateado agregando los valores indicados en las posiciones correspondientes.
        // Es más seguro, fiable y manejable que usar concatenaciones de strings.
        $query = sprintf(
            "UPDATE prestamos
                    SET estado = %d
                    WHERE idPrestamo = %d",
            $estado,
            $idPrestamo,
        );

        // Devolvemos el resultado de realizar la consulta en la base de datos.
        return realizarQuery($query);
    } catch (Exception $e) {
        agregarError("Ha ocurrido un errror: " . $e->getMessage(), "Error inesperado");
    }
    return false;
}