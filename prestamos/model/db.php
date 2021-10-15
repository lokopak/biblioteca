<?php
// require_once es igual que 'import' con la diferencia de que si el archivo
// no se encuentra, se devuelve un error grave y se asegura que el archivo se carga
// en la memoria una sola vez. Esto sirve para no duplicar un código que queremos
// que solo se carge una vez.

// Cargamos el contenido del archivo conexion.php (si no ha sido cargado anteriormente)
require_once("../conexion.php");
// Cargamos el archivo necesario para paginar los elementos encontrados.
require_once("../paginador.php");

// Unos posibles estados en los préstamos.
$estadosPrestamos = [
    "devuelto",   // 0 =>  El préstamo ha sido devuelto sin ningúna incidencia.
    "activo",     // 1 =>  El préstamo está activo
    "retrasado",  // 2 =>  El préstamo está activo y con retraso en la entrega.
    "defectuoso"  // 3 =>  El préstamo ha sido entregado pero con defectos en el libro.
];

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
            $query = "SELECT prestamos.*, socios.idSocio, socios.nombre, socios.apellidos, libros.titulo
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
function prestamosAcutalizar($prestamo)
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
        $prestamo['idPrestamo'],
        $prestamo['estado'],
        $prestamo['fechaDevolucion']
    );

    // Devolvemos el resultado de realizar la consulta en la base de datos.
    return realizarQuery($query);
}

/**
 * Esta función nos ayuda a rellenar los valores de
 * un préstamo sin tener que repetir todo el código
 * de nuevo.
 * 
 * @param array $datos Un array con todos los datos que se van a
 *             asignar al prestamo.
 * @param array $prestamo Un array con los valores del préstamo.
 *              NOTA: $prestamo = null indica que el valor préstamo es opcional y que
 *                                     en caso de no proporcionarlo, toma el valor
 *                                     por defecto de null.
 * 
 * @return array Devuelve el préstamo una vez modificado con los datos recibidos.
 */
function rellenarPrestamo($datos, $prestamo = null)
{
    // Si el préstamo es null estamos crando uno nuevo, asíque iniciamos el $prestamo como un array.
    if ($prestamo === null) {
        $prestamo = [];
    }

    // NOTA: HABRÍA QUE DAR UN VALOR POR DEFECTO EN EL CASO DE QUE ALGÚN VALOR NECESARIO NO VENGA
    // EN EL ARRAY CON LOS DATOS.

    // Con este if comprobamos que el dato correspondiente viene dentro del array y que no son iguales
    if (isset($datos["idSocio"])) {
        // Con el refundimiento (int) nos aseguramos de que el valor almacenado es un entero.
        $prestamo["idSocio"] = (int)$datos["idSocio"];
    }
    // Con este if comprobamos que el dato correspondiente viene dentro del array y que no son iguales
    if (isset($datos["idLibro"])) {
        // Con el refundimiento (int) nos aseguramos de que el valor almacenado es un entero.
        $prestamo["idLibro"] = (int)$datos["idLibro"];
    }
    // Con este if comprobamos que el dato correspondiente viene dentro del array y que no son iguales
    if (isset($datos["fechaInicio"])) {
        // Con el refundimiento (string) nos aseguramos de que el valor almacenado es un string.
        $prestamo["fechaInicio"] = (string)$datos["fechaInicio"];
    }
    // Con este if comprobamos que el dato correspondiente viene dentro del array y que no son iguales
    if (isset($datos["fechaDevolucion"])) {
        // Con el refundimiento (string) nos aseguramos de que el valor almacenado es un string.
        $prestamo["fechaDevolucion"] = (string)$datos["fechaDevolucion"];
    }
    // Con este if comprobamos que el dato correspondiente viene dentro del array y que no son iguales
    if (isset($datos["estado"])) {
        // Con el refundimiento (int) nos aseguramos de que el valor almacenado es un entero.
        $prestamo["estado"] = (int)$datos["estado"];
    }

    return $prestamo;
}