<?php

// Mostramos el contenido html del head
require_once(__DIR__ . "/../view/head.php");
// Cargamos el código necesario para manejar la tabla pedidos en la base de datos.
require_once(__DIR__ . "/model/db.php");
// Cargamos el código necesario para manejar la tabla de libros en la base de datos
require_once(__DIR__ . "/../libros/model/db.php");
// Cargamos el código necesario para manejar la tabla de socios en la base de datos.
require_once(__DIR__ . "/../socios/model/db.php");
// Cargamos las funciones y constantes relativas a un socio.
require_once(__DIR__ . "/../socios/model/socio.php");
// Cargamos las funciones y constantes relativas a un libro.
require_once(__DIR__ . "/../libros/model/libro.php");
// Cargamos las funciones y constantes relativas a un préstamo.
require_once(__DIR__ . "/model/prestamo.php");
// Cargamos las funciones necesarias para acceder a los datos de la request (solicitud)
require_once(__DIR__ . "/../conexion/request.php");

// En caso de que la solicitud sea un post (es decir, se haya enviado el form con los datos para el nuevo préstamo)
// Ejecutamos el código para agregar el nuevo préstamo en la base de datos.
if (esPost()) {
    // Obtenemos todos los datos necesarios desde la petición POST
    // Obtenemos todos los datos necesarios desde la petición POST

    // Con esto nos aseguramos de que el valor lo recibimos correctamento o bien le damos un valor nulo para indicar lo contrario.
    // NOTA: es recomendable no usar mucho los arrays $_REQUEST, $_POST y $_GET para evitar que por error se modifiquen esos datos
    // y más adelante puedan producir fallos o funcionamientos inesperados.

    // Obtenemos la fecha de inicio que envá el form.
    $fechaInicio = obtenerDesdePost("fechaInicio", null);

    // Obtenemos la id del libro que envá el form.
    $idSocio = (int) obtenerDesdePost("libro", null);

    // Obtenemos la id del socio que envá el form.
    $idLibro = (int) obtenerDesdePost("socio", null);

    // Si falta alguna de las variables necesarias para crear el nuevo préstamo, enviamos un error.
    if ($idLibro === null || $idSocio === NULL || $fechaInicio === NULL) {
        agregarMensaje("Faltan alguno de los datos necesarios  $idLibro, $idSocio, $fechaInicio", "danger");

        // Aquí se le pueden agregar variables para indicar que valor es el que falta en el html.
    }
    // Parece que los datos están correctos, continuemos...
    else {

        // Comprobamos que el libro existe.
        $libro = librosBuscarUno($idLibro);
        // Comprobamos que el socio existe.
        $socio = sociosBuscarUno($idSocio);
        print_r($libro["estado"]);

        // Nos aseguramos de que el libro existe y está disponible.
        // NOTA: El uso de constantes como LIBRO_ESTADO_DISPONIBLE nos facilita el uso de valores que se usan en distintas partes
        // de la aplicación pero que núnca van a cambiar y si le cambiamos de valor, el cambio afecta a toda la aplicación sin
        // necesidad de buscar cada lugar donde se ha empleado.
        if ($libro === null || (int)$libro['estado'] !== LIBRO_ESTADO_DISPONIBLE) {
            agregarMensaje("El libro no existe o no se encuentra disponible en estos momentos", "warning");
        }
        // En caso de que el socio no exista, no continuamos y mostramos un mensaje de error
        else if ($socio === null) {
            agregarMensaje("El socio indicado no existe", "danger");
        }
        // Todo parece correcto, vamos a guardar el préstamo
        else {

            // Generamos la fecha de devolución agregando 5 días "por ejemplo" a la fecha de inicio indicada.
            $fechaDevolucion = date("Y-m-d", strtotime($fechaInicio . "5 days"));
            // En principio todos los préstamos nuevos inicial con el estado 1 (activo)
            $estado = PRESTAMO_ESTADO_ACTIVO; // De nuevo, emplear constantes, nos facilita controlar este tipo de datos que tienen valores fijos

            // Vamos a generar el array con los datos del préstamo. Esto nos ahorra código y asegura que los datos
            // se manejan correctamente.
            //NOTA: En la última semana se ha visto POO, esta operación podría usarse para generar un nuevo Prestamo directamente con los datos recibidos.
            $prestamo = rellenarPrestamo([
                "idLibro" => $idLibro,
                "idSocio" => $idSocio,
                "fechaInicio" => $fechaInicio,
                "fechaDevolucion" => $fechaDevolucion,
                "estado" => $estado
            ]);

            // Insertamos el préstamo
            $idPrestamo = prestamosInsertar($prestamo);

            // Si el préstamo se ha agregado corretament, nos devuelve la id del nuevo préstamo.
            if ($idPrestamo && $idPrestamo > 0) {
                // Actualicemos el estado del libro!!!!
                $resultado = librosActualizarEstado($idLibro, LIBRO_ESTADO_PRESTADO);
                if (!$resultado) {
                    agregarMensaje("No se ha podido actualizar el estado del libro correctamente", "warning");
                }
                // En lugar de enviar un mensaje, simplemente podemos mostrar esta pantalla para que el usuario elija que quiere seguir haciendo.
                require(__DIR__ . "/view/creado.php");
                return;
            }
            // De lo contrario
            else {
                agregarMensaje("No se ha podido agregadar el préstamo correctamete", "warning");
            }
        }
    }
}

// Las páginas y los límites los enviamos como null para que se cargen todos los que se encuentren en la base de datos.
$libros = librosBuscarTodos(null, null, "apellidos", "ASC");
$socios = sociosBuscarTodos(null, null, "apellidos", "ASC", SOCIO_ESTADO_ACTIVO);

// Mostramos el contenido html de la página
require(__DIR__ . "/view/crear.php");

// Mostramos el contenido html del footer.
require_once(__DIR__ . "/../view/footer.php");