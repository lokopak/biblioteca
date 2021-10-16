<!-- Recibe la id y el estado del libro y lo cambia a disponible-->
<?php
require_once(__DIR__ . '/../view/head.php');
require_once(__DIR__ . '/../conexion/conexion.php');
require_once(__DIR__ . '/model/db.php');
require_once(__DIR__ . '/model/prestamo.php');
require_once(__DIR__ . '/../libros/model/db.php');
require_once(__DIR__ . '/../libros/model/libro.php');
// Cargamos las funciones necesarias para acceder a los datos de la request (solicitud)
require_once(__DIR__ . "/../conexion/request.php");


// A esta función sólo vamos a entrar desde el método GET. Por lo tanto, si se recibe un POST, es una petición extraña y no debemos atenderla.
if (esPost()) {
    // Agregamos el mensaje y terminamos.
    agregarError("La petición no es correcta.", "Error");
    // Para que la página siga funcionando correctamente debemos cargar el foorter (en el esán los javascrpt necesarios para que funcione bootstrap)
    require_once(dirname(__FILE__) . "/../view/footer.php");
    return;
}

/*
if (isset($res['idLibro'])) {
    $idLibro = $res['idLibro'];
}
else if (isset($_REQUEST['idLibro'])) {
    $idLibro = $_REQUEST['idLibro'];
}

$query = "SELECT idPrestamo FROM prestamos WHERE idLibro = $idLibro AND estado = 1";
$resultado = mysqli_query($conexion,$query);
$datos = mysqli_fetch_array($resultado);
$idPrestamo = $datos['idPrestamo'];
*/

// OJO: no se recogen como (int) ahora, puesto que el null lo convierte en 0, y no nos interesa ahora.
$estado = obtenerDesdeGet('estado', null);
$idPrestamo = obtenerDesdeGet('idPrestamo', null);

// Si no se proporciona una id de prestamo o el nuevo estado, la petición tampoco es correcta. Terminamos!!!
if (null === $idPrestamo || null === $estado) {
    // Agregamos el mensaje y terminamos.
    agregarError("La petición no es correcta.", "Error");
    // Para que la página siga funcionando correctamente debemos cargar el foorter (en el esán los javascrpt necesarios para que funcione bootstrap)
    require_once(dirname(__FILE__) . "/../view/footer.php");
    return;
}
// Para asegurarnos de que todo funcione bien, convertimos la $idPrestamo y del estado en un integer ahora.
$idPrestamo = (int) $idPrestamo;
$estado = (int) $estado;

$prestamo = prestamosBuscarUno($idPrestamo);

// El préstamo no existe... pues un ERROR 404 xPP
if (null === $prestamo) {
    require(__DIR__ . "/../view/no-encontrado.php");
    // Para que la página siga funcionando correctamente debemos cargar el foorter (en el esán los javascrpt necesarios para que funcione bootstrap)
    require_once(dirname(__FILE__) . "/../view/footer.php");
    return;
}

$idLibro = (int) $prestamo['idLibro'];

$libro = librosBuscarUno($idLibro);

// No se ha encontrado el libro?? Pués toma error!!
if (null === $libro) {
    agregarError("No se ha encontrado el libro asociado a este préstamo.", "Error");
    // Para que la página siga funcionando correctamente debemos cargar el foorter (en el esán los javascrpt necesarios para que funcione bootstrap)
    require_once(dirname(__FILE__) . "/../view/footer.php");
    return;
}


// Actualizamos el estado del libro.
// Pero antes necesitamos convertir el estado del préstamo en un estado de libro:
switch ($estado) {
        // En estos dos casos, el libro está devuelto.
    case PRESTAMO_ESTADO_DEVUELTO:
    case PRESTAMO_ESTADO_DEVUELTO_FUERA_PLAZO:
        $estadoLibro = LIBRO_ESTADO_DISPONIBLE;
        break;
        // En estos dos casos, el libro sigue prestado.
    case PRESTAMO_ESTADO_ACTIVO:
    case PRESTAMO_ESTADO_FUERA_PLAZO:
        $estadoLibro = LIBRO_ESTADO_PRESTADO;
        break;
    case PRESTAMO_ESTADO_CON_DEFECTOS:
        $estadoLibro = LIBRO_ESTADO_DETERIORADO;
        break;
        // No sabemos que ha pasado aquí... mejor dejemos el libro como no disponible y añadamos un mensaje.
    default:
        // Agregamos el mensaje y terminamos.
        agregarError("La petición no es correcta.", "Error");
        // Para que la página siga funcionando correctamente debemos cargar el foorter (en el esán los javascrpt necesarios para que funcione bootstrap)
        require_once(dirname(__FILE__) . "/../view/footer.php");
        return;
}

$resultado = prestamosActualizarEstado($idPrestamo, $estado);

// El préstamos se ha actualizado correctamente. 
if ($resultado) {
    $resultado = librosActualizarEstado($idLibro, $estadoLibro);

    // Hemos terminado, volvamos a comprobar que todo ha ido bien...
    if ($resultado) {
        // Todo ok!!!
        require(__DIR__ . "/view/devuelto.php");
        return;
    }
}
// ALGO HA FALLADO!!

// Agregamos el mensaje de error y terminamos.
agregarError("La petición no es correcta.", "Error");
// Para que la página siga funcionando correctamente debemos cargar el foorter (en el esán los javascrpt necesarios para que funcione bootstrap)
require_once(dirname(__FILE__) . "/../view/footer.php");


?>