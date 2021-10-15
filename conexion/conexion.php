<?php
// require_once es igual que 'import' con la diferencia de que si el archivo
// no se encuentra, se devuelve un error grave y se asegura que el archivo se carga
// en la memoria una sola vez. Esto sirve para no duplicar un código que queremos
// que solo se carge una vez.
// Para evitar errores usamos dirname(__FILE__) para determinar el path real de los archivos.
require_once(dirname(__FILE__) . "/../error/error.php");

/**
 * Establece la conexión con la base de datos.
 * En caso de no poder establecer la conexión
 * lanza una excepción.
 * 
 * @return mysqli $conexion Devuelve la conexión que se ha establecido con
 *         la base de datos.
 * @throws Excepcion Si no se ha podido establecer la conexión envia
 *         una excepción para que se actue de la forma precisa en cada
 *         situación.
 */
function conectarBaseDatos()
{
    $host = "localhost";
    $usuario = "biblioteca";
    $password = "biblioteca";
    $baseDatos = "biblioteca";

    // Tratamos de conectar con la base de datos.
    $conexion = mysqli_connect($host, $usuario, $password, $baseDatos);

    // Si no se ha podido establecer la conexión, lanzamos una excepción para poder controlar.
    if (!$conexion) {
        throw new Exception("No se ha podido establecer conexión con la base de datos: " . mysqli_connect_error());
    }

    // Devolvemos la conexión (pero no a los estudios centrales :P )
    return $conexion;
}

/**
 * Cierra una conexión con la base de datos.
 * En caso de no existir la conexión o
 * lanza una excepción.
 * 
 * @param mysqli $conexion La conexión que se desea cerrar.
 * 
 * @return void No devuelve ningún valor.
 * 
 * @throws Exception Lanza una excepción si se ha producido
 *             algun error durante el cierrre de la conexión.
 *          
 */
function cerrarConexion($conexion)
{
    // La conexión no existe o no está establecida. No hay nada que hacer.
    if (!isset($conexion)) {
        return;
    }

    // En caso de que no se haya podido cerrar correctamente la conexión.
    // Enviamos una excepción para comunicarlo.
    if (!mysqli_close($conexion)) {
        throw new Exception("No se ha podido cerrar la conexión correctamente. ");
    }
}

/**
 * Realiza un query a la base de datos.
 * Establece la conexión y cierra la conexión
 * después de realizar la consulta.
 * 
 * @param string $query Un string con la query que se desea ejecutar.
 * @return mixed El valor obtenido desde la base de datos, puede ser nulo, un objeto, un array, un número o un booleano.
 */
function realizarQuery($query)
{
    // Si necesitamos acceder dentro de una función a una variable que está fuera (variable global)
    // Es necesario indicar que vamos a usarla con esta sentencia.
    global $errores;

    // Declaramos la variable fuera del bloque try para poder
    // acceder a ella en el catch y fuera del bloque try-catch.
    $conexion = null;
    $resultado = null;
    try {
        // Realizamos la conexión
        $conexion = conectarBaseDatos();
        // Si hay conexión, enviamos la consulta.
        if ($conexion) {
            // Recogemos el resultado de la consulta
            $resultado = mysqli_query($conexion, $query);

            // Cuando una consulta a la base de datos falla, envía un valor null o un false dependiendo del tipo de consulta.
            // Por tanto, si eso pasa, mostramos el error en el html.
            if ($resultado === null || $resultado === false) {
                agregarError(
                    "Se ha producido un error durante la realización de la consulta:<br/>
                " . mysqli_error($conexion),
                    "Error en SQL"
                );

                // Devolvemos un valor nulo para indicar que no se ha recogido ningún valor de la base de datos.
                return null;
            }

            // Devolvemos el resultado obtenido en la consulta.
            $id = mysqli_insert_id($conexion);

            if ($id > 0) {
                $resultado = $id;
            }

            // Devolvemos el resultado obtenido en la consulta.
            return $resultado;
        }
    } catch (Exception $e) {
        // En caso de que haya fallado la conexión
        if (!isset($conexion)) {
            agregarError("No se ha podido establecer correctamente la conexión con la base de datos.", "Error de SQL");
        }
        // Si ha fallado la consulta.
        else if ($resultado == null || $resultado == false) {
            agregarError("La consulta ha fallado: " . mysqli_error($conexion), "Error de SQL");
        }
        // No tenemos ni idea de lo que ha pasado
        else {
            // La excepción $e es un objeto y getMessage es un método que devuelve el mensaje del error de la excepción.
            // Lo agreamos aquí para dar una idea de lo que ha sucedido al usuario.
            agregarError("Se ha producico un error inesperado: " . $e->getMessage(), "Error de SQL");
        }
    }

    // En cualquier caso, cerramos la conxión si está estaleceda.
    if ($conexion) {
        cerrarConexion($conexion);
    }

    // Devolvemos el resultado obtenido en la consulta.
    return null;
}