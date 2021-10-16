<?php


/**
 * 
 */
// class Prestamo
// {
/**
 * Este archivo contiene las constantes y funciones relativas a un préstamo.
 */

// Constantes con los valores de los posibles estados de un préstamo.
const PRESTAMO_ESTADO_DEVUELTO = 0;
const PRESTAMO_ESTADO_ACTIVO = 1;
const PRESTAMO_ESTADO_DEVUELTO_FUERA_PLAZO = 2;
const PRESTAMO_ESTADO_CON_DEFECTOS = 3; // El libro se ha devuelto pero con daños.
const PRESTAMO_ESTADO_FUERA_PLAZO = 4; // El libro no se ha devuelto y está fuera de plazo

// Array con los nombres de todos los estados para facilitar mostrar en en html
const PRESTAMO_ESTADOS = [
    PRESTAMO_ESTADO_DEVUELTO => "Devuelto",
    PRESTAMO_ESTADO_ACTIVO => "Activo",
    PRESTAMO_ESTADO_DEVUELTO_FUERA_PLAZO => "Devuelto fuera plazo",
    PRESTAMO_ESTADO_CON_DEFECTOS => "Dañado",
    PRESTAMO_ESTADO_FUERA_PLAZO => "Fuera de plazo"
];

//     private $idPrestamo;

//     private $idSocio;

//     private $estado;
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
function rellenarPrestamo($datos, &$prestamo = null)
{
    // Si el préstamo es null estamos crando uno nuevo, asíque iniciamos el $prestamo como un array.
    if ($prestamo === null) {
        $prestamo = [];
    }

    // NOTA: HABRÍA QUE DAR UN VALOR POR DEFECTO EN EL CASO DE QUE ALGÚN VALOR NECESARIO NO VENGA
    // EN EL ARRAY CON LOS DATOS.

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
        $prestamo["estado"] = (int) $datos["estado"];
    }

    return $prestamo;
}