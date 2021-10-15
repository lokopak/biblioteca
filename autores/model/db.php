<?php
require_once(dirname(__FILE__) . "/../../conexion/conexion.php");

/**
 * Busca todos los autores que se encuentren
 * en la tabla de autores y respondan a las 
 * condiciones indicadas.
 * 
 * @throws Exception
 */
function autoresBuscarTodos()
{

    try {
        $autores = [];
        // Montamos la query para realizar la búsqueda.
        $query = "SELECT * FROM autores";

        // Agregamos las modificaciones del query aquí.

        // Enviamos la consulta
        $resultado = realizarQuery($query);

        // Si se ha obtenido un resultado
        if ($resultado) {
            // Agregamos todos los autores encontrados en el array de autores.
            // mysqli_fetch_all devuelve un array con todas las entradas que ha encontrado con el query.
            $autores = mysqli_fetch_all($resultado, MYSQLI_ASSOC);
        }

        // Devolvemos el array de autores.
        return $autores;
    } catch (Exception $e) {
        agregarError("Ha ocurrido un errror: " . $e->getMessage(), "Error inesperado");
    }

    // Se ha producido un error, devolvemos un null.
    return null;
}

/**
 * Inserta un nuevo autor en la tabla de autores.
 * 
 * @param $nombre El nombre del autor
 * @param $apellidos Los apellidos del autor
 * @param $nacionalidad La nacionalidad del autor
 * @param $fechaNacimiento La fecha de nacimiento del autor.
 * 
 * @return mixed El resultado de la operación.
 *      Puede ser:
 *          - Entero (int) en caso de insertarse correctamente.
 *            El entero corresponde a la idAutor asignada al nuevo autor.
 *          - null en caso de fallo
 * 
 * @throws Exception
 */
function autoresInsertarNuevo($nombre, $apellidos, $nacionalidad, $fechaNacimiento)
{
    try {

        $query = "INSERT INTO autores (nombre, apellidos, nacionalidad, fechaNacimiento) values ('" . $nombre . "','" . $apellidos . "','" . $nacionalidad . "','" . $fechaNacimiento . "')";

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

/**
 * Busca un autor en la tabla correspondiente
 * que tenga por id la idAutor proporcionada.
 * 
 * @param $idAutor La id del autor que se queire
 *          encontrar.
 * 
 * @return array|null
 */
function autoresBuscarUno($idAutor)
{

    $query = "SELECT * FROM autores WHERE idAutor='" . $idAutor . "'";

    // Enviamos la query
    $resultado = realizarQuery($query);

    $autor = mysqli_fetch_assoc($resultado);

    return $autor;
}

/**
 * Actualiza un autor con los nuevos datos
 * recividos.
 * 
 * @param $nombre El nuevo nombre del autor
 * @param $apellidos Los nuevos apellidos del autor
 * @param $nacionalidad La nueva nacionalidad del autor
 * @param $fechaNacimiento La nueva fecha de nacimiento del autor.
 * @param $idAutor La id correspondiente al autor que se desea actualizar.
 * 
 * @return boolean El resultado de la operación
 * 
 * @throws Exception 
 */
function autoresActualizar($nombre, $apellidos, $nacionalidad, $fechaNacimiento, $idAutor)
{
    try {

        $query = sprintf(
            "UPDATE autores SET
        nombre='%s',
        apellidos='%s',
        nacionalidad='%s',
        fechaNacimiento='%s'
        WHERE idAutor = %d",
            $nombre,
            $apellidos,
            $nacionalidad,
            $fechaNacimiento,
            $idAutor
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