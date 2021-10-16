<?php
require_once(__DIR__ . '/../view/head.php');
// Cargamos los datos necesarios gestionar los socios.
require_once(__DIR__ . "/model/socio.php");
// Cargamos las funciones para recoger datos desde la Petición del navegador (Request).
require_once(__DIR__ . "/../conexion/request.php");

// Si se ha recibido la petición mediante el form, ejecutamos la creación del nuevo libro.
if (esPOST()) {

    // Cargamos las funciones necesarias para poder interactuar con la tabla de socios de la base de datos.
    require_once(__DIR__ . '/model/db.php');

    // Recogemos todos los datos desde el post.
    //  Para facilitar y evitar repetir tanas veces el código para recoger datos desde el post:
    //  $DNI = $_POST['DNI'];
    //  o 
    //  if (isset($_POST['DNI'];)) {
    //      $DNI = $_POST['DNI'];
    //  }
    //  else {
    //     $DNI = null;
    //  }
    // Usamos una función que contiene ese código.
    $DNI = obtenerDesdePost('DNI', null);
    $nombre = obtenerDesdePost('nombre', null);
    $apellidos = obtenerDesdePost('apellidos', null);
    $fechaNacimiento = obtenerDesdePost('fechaNacimiento', null);
    $direccion = obtenerDesdePost('direccion', null);
    $telefono = obtenerDesdePost('telefono', null);
    $email = obtenerDesdePost('email', null);

    //NOTA: Aquí habría que verificar y validar todos los datos recividos.

    // De inicio un socio se da de alta como activo.
    $estado = SOCIO_ESTADO_ACTIVO;
    // Agregamos a los datos la fecha de hoy como fecha de alta.
    $fechaAlta = date("Y/m/d", time());
    $resultado = sociosInsertarNuevo($nombre, $apellidos, $direccion, $fechaNacimiento, $DNI, $telefono, $email, $estado, $fechaAlta);
    if ($resultado) {
        require(__DIR__ . "/view/creado.php");
        return;
    }
}

// En caso contrario, simplemente mostramos el form. Si hubiera algún error en los datos se podrían mostrar
require(__DIR__ . "/view/crear.php");

require_once(__DIR__ . '/../view/footer.php');