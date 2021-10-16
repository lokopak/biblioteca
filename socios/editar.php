<?php

// Mostramos el contenido html del head
require_once(__DIR__ . "/../view/head.php");

// Cargamos los datos necesarios para gestionar socios
require_once(__DIR__ . "/model/socio.php");

// Cargamos las funciones para recoger datos desde la Request.
require_once(__DIR__ . "/../conexion/request.php");

$idSocio = obtenerDesdeGet("idSocio", null);

// Si no se proporciona ninguna idSocio, mostramos un error
if (null === $idSocio) {
    agregarError("La petición no es correcta.", "Error");
    // Mostrar no encontrado.    
    require_once(dirname(__FILE__) . "/../view/footer.php");
    return;
}

// Cargamos el archivo necesario para manejar la tabla de socios.
require_once(__DIR__ . "/model/db.php");

// Buscamos el socio para comprobar que existe.
$socio = sociosBuscarUno((int)$idSocio);

// Si no existe el socio... mostramos la página de no encontrado
if (null === $socio) {
    require(__DIR__ . "/../view/no-encontrado.php");
    return;
}

// Si recibimos la petición desde el form
if (esPost()) {

    // $idSocio = obtenerDesdePost('idSocio', null);
    $DNI = obtenerDesdePost('DNI', null);
    $nombre = obtenerDesdePost('nombre', null);
    $apellidos = obtenerDesdePost('apellidos', null);
    $fechaNacimiento = obtenerDesdePost('fechaNacimiento', null);
    $direccion = obtenerDesdePost('direccion', null);
    $telefono = obtenerDesdePost('telefono', null);
    $email = obtenerDesdePost('email', null);
    $estado = obtenerDesdePost('estado', null);

    //NOTA: Aquí habría que verificar y validar todos los datos recividos.

    // Normalmente la fecha de alta no se actualiza núnca.
    // $fechaAlta = obtenerDesdePost('fechaAlta', null);

    $resultado = sociosActualizar($nombre, $apellidos, $direccion, $fechaNacimiento, $DNI, $telefono, $email, (int) $estado, $idSocio);

    if ($resultado) {
        agregarMensaje("Socio actualziado correctamente", "success");
    }
}

if (hayMensajes()) {
    mostrarMensajes();
}

// Mostramos el contenido html de la página
require(__DIR__ . "/view/editar.php");

// Mostramos el contenido html del footer.
require_once(__DIR__ . "/../view/footer.php");