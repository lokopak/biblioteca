<?php

// Mostramos el contenido html del head
require_once(__DIR__ . "/../view/head.php");
// Cargamos el código necesario para manejar la tabla pedidos en la base de datos.
require_once(__DIR__ . "/model/db.php");
// Cargamos el código necesario para manejar la tabla de libros en la base de datos
require_once(__DIR__ . "/../libros/model/db.php");
// Cargamos el código necesario para manejar la tabla de libros en la base de datos
require_once(__DIR__ . "/../libros/model/libro.php");
// Cargamos el código necesario para manejar la tabla de socios en la base de datos.
require_once(__DIR__ . "/../socios/model/db.php");
// Cargamos las funciones necesarias para acceder a los datos de la request (solicitud)
require_once(__DIR__ . "/../conexion/request.php");
// Cargamos las funciones y constantes relativas a un préstamo.
require_once(__DIR__ . "/model/prestamo.php");
// Cargamos las funciones y constantes relativas a un socio.
require_once(__DIR__ . "/../socios/model/socio.php");

// Usaremos esta variable más adelante para mostrar el contenido de la página.
$existe = false;

// En caso de que la solicitud sea un post (es decir, se haya enviado el form con los datos para el nuevo préstamo)
// Ejecutamos el código para agregar el nuevo préstamo en la base de datos.
if (esPost()) {

    /**
     * Para no tener que escribir todo este código para cada valor que queremos tomar desde el POST, hemos creado una función
     * que nos ahorra hacerlo y en lugar de escribir:
     * 
     * if (isset($_POST["fechaInicio"])) {
     *  $fechaInicio = $_POST["fechaInicio"];
     * }
     * else {
     *  $fechaInicio = null;
     * }
     * 
     * Simplemente necesitamos escribir:
     * $fechaInicio = obtenerDesdePost('fechaInicio', null);
     */
    // Con esto nos aseguramos de que el valor lo recibimos correctamento o bien le damos un valor nulo para indicar lo contrario.
    // NOTA: es recomendable no usar mucho los arrays $_REQUEST, $_POST y $_GET para evitar que por error se modifiquen esos datos
    // y más adelante puedan producir fallos o funcionamientos inesperados.

    // La base de datos no usa el número 0, ni números negativos para el AUTO_INCREMENT por lo que podemos usar cualquiera
    // de esos valores para indicar que la idPrestamo no se ha recibido o es errónea.
    $idPrestamo = (int)obtenerDesdePost("idPrestamo", -1);
    $idLibro = (int)obtenerDesdePost("idLibro", -1);
    $idSocio = (int)obtenerDesdePost("idSocio", -1);
    $fechaInicio = obtenerDesdePost("fechaInicio", null);
    $fechaDevolucion = obtenerDesdePost("fechaDevolucion", null);
    $estado = (int)obtenerDesdePost("estado", null);

    // Con esto obtenemos la fecha de hoy Con formato año-mes-día (el que maneja la base de datos)
    $fechaDeHoy = date("Y-m-d", time());

    // Mostramos un mensaje para indicar que el préstamo está fura de plaza de entrega.
    if (strtotime($fechaDevolucion) < strtotime($fechaDeHoy) && $estado !== 0) {
        agregarMensaje("El préstamo está fuera de plazo.", "warning");
    }

    // Si falta alguna de las variables necesarias para editar el préstamo, enviamos un error.
    // Las ids del préstamo, libro y socio son obligatorias y si no vienen en el post, la petición no es correcta.
    if ($idPrestamo <= 0 || $idLibro <= 0 || $idSocio <= 0) {
        // No no 
        agregarError("La petición no es correcta.", "Error");
        // Mostrar no encontrado.    
        require_once(dirname(__FILE__) . "/../view/footer.php");
        return;
    }
    // En el caso de fecha de inicio, fecha de devolución y estado, enviamos un mensaje para informar de que falta el dato.
    else if ($fechaInicio === null || $fechaDevolucion === null || $estado === null) {
        agregarMensaje("Faltan campos por rellenar", "danger");
    }
    // Si todo está correcto, actualizamos el préstamo.
    else {
        // Buscamos el préstamo para comprobar que existe.
        $prestamo = prestamosBuscarUno($idPrestamo);
        //NOTA: Se debe comprobar también el libro y el autor.

        // No se ha encontrado el préstamo
        if (!$prestamo) {
            // Alerta no existe el préstamo.
            agregarMensaje("No existe ningún prestamo con la id proporcionada", "danger");
        } else {

            // Indicamos que el préstamo existe para que muestre la página de editar.
            $existe = true;

            // Vamos a asignar valores al array del préstamo. Esto nos ahorra código y asegura que los datos
            // se manejan correctamente.
            $prestamo = rellenarPrestamo([
                "idLibro" => $idLibro,
                "idSocio" => $idSocio,
                "fechaInicio" => $fechaInicio,
                "fechaDevolucion" => $fechaDevolucion,
                "estado" => $estado
            ], $prestamo);

            // Actualizamos el préstamo en la base de datos.
            $resultado = prestamosActualizar($prestamo);

            // El préstamo se ha actualizado correctamente.
            // mysqli_query devuelve un booleano en caso de un UPDATE.
            if ($resultado) {
                agregarMensaje("El préstamo ha sido actualizado correctamente", "success");
            } else {
                // Algo ha fallado en la actualización.
                agregarMensaje("No se ha podido actualizar el préstamo correctamente. ", "danger");
            }
        }
    }
}
// Si la petición es por medio de GET, comprobamos que viene la idSocio en la url.
else {
    // Recogemos la idSocio desde la url y comprobamos que existe.
    $idPrestamo = obtenerDesdeGet("idPrestamo", null);

    // Si no se proporciona ninguna idSocio, mostramos un error
    if (null === $idPrestamo) {
        agregarError("La petición no es correcta.", "Error");
        // Mostrar no encontrado.    
        require_once(dirname(__FILE__) . "/../view/footer.php");
        return;
    }

    // Buscamos el socio para comprobar que existe.
    $prestamo = prestamosBuscarUno((int)$idPrestamo);

    // Si no existe el socio... mostramos la página de no encontrado
    if (null === $prestamo) {
        require(__DIR__ . "/../view/no-encontrado.php");
        return;
    }
}
// El préstamo existe y no ha habido ningún problema, mostramos la página de editar.
// NOTA: no es necesario guardar estos datos en variables, no se van a usar.
// $pagina = 1;
// $limite = 10;
// $ordenPor = "apellidos";
// $orden = "ASC";
// $estado = null;
// Las páginas y los límites los enviamos como null para que se cargen todos los que se encuentren en la base de datos.
$libros = librosBuscarTodos(null, null, "titulo", "ASC", LIBRO_ESTADO_DISPONIBLE);
$socios = sociosBuscarTodos(null, null, "apellidos", "ASC", SOCIO_ESTADO_ACTIVO);

if (hayMensajes()) {
    mostrarMensajes();
}
require(__DIR__ . "/view/editar.php");

// Mostramos el contenido html del footer.
require_once(__DIR__ . "/../view/footer.php");