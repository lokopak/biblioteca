<?php

// Mostramos el contenido html del head
require_once(__DIR__ . "/../view/head.php");

// Cargamos los datos necesarios para gestionar socios
require_once(__DIR__ . "/model/socio.php");

// Cargamos las funciones para recoger datos desde la Request.
require_once(__DIR__ . "/../conexion/request.php");

// Cargamos el archivo necesario para manejar la tabla de socios.
require_once(__DIR__ . "/model/db.php");

// Si recibimos la petición desde el form
if (esPost()) {

    // Recogemos la idSocio desde el POST y comprobamos que existe.
    $idSocio = obtenerDesdePost("idSocio", null);

    // Si no se proporciona ninguna idSocio, mostramos un error
    if (null === $idSocio) {
        agregarError("La petición no es correcta.", "Error");
        // Mostrar no encontrado.    
        require_once(dirname(__FILE__) . "/../view/footer.php");
        return;
    }
    // Buscamos el socio para comprobar que existe.
    $socio = sociosBuscarUno((int)$idSocio);

    // Si no existe el socio... mostramos la página de no encontrado
    if (null === $socio) {
        require(__DIR__ . "/../view/no-encontrado.php");
        return;
    }

    // $idSocio = obtenerDesdePost('idSocio', null);
    $DNI = obtenerDesdePost('DNI', null);
    $socio["DNI"] = $DNI;
    $nombre = obtenerDesdePost('nombre', null);
    $socio["nombre"] = $nombre;
    $apellidos = obtenerDesdePost('apellidos', null);
    $socio["apellidos"] = $nombre;
    $fechaNacimiento = obtenerDesdePost('fechaNacimiento', null);
    $socio["fechaNacimiento"] = $nombre;
    $direccion = obtenerDesdePost('direccion', null);
    $socio["direccion"] = $nombre;
    $telefono = obtenerDesdePost('telefono', null);
    $socio["telefono"] = $nombre;
    $email = obtenerDesdePost('email', null);
    $socio["email"] = $nombre;
    $estado = obtenerDesdePost('estado', null);
    $socio["estado"] = (int) $nombre;

    //NOTA: Aquí habría que verificar y validar todos los datos recividos.

    // Normalmente la fecha de alta no se actualiza núnca.
    // $fechaAlta = obtenerDesdePost('fechaAlta', null);

    $resultado = sociosActualizar($nombre, $apellidos, $direccion, $fechaNacimiento, $DNI, $telefono, $email, (int) $estado, $idSocio);

    if ($resultado) {
        agregarMensaje("Socio actualziado correctamente", "success");
    }
}
// Si la petición es por medio de GET, comprobamos que viene la idSocio en la url.
else {
    // Recogemos la idSocio desde la url y comprobamos que existe.
    $idSocio = obtenerDesdeGet("idSocio", null);

    // Si no se proporciona ninguna idSocio, mostramos un error
    if (null === $idSocio) {
        agregarError("La petición no es correcta.", "Error");
        // Mostrar no encontrado.    
        require_once(dirname(__FILE__) . "/../view/footer.php");
        return;
    }

    // Buscamos el socio para comprobar que existe.
    $socio = sociosBuscarUno((int)$idSocio);

    // Si no existe el socio... mostramos la página de no encontrado
    if (null === $socio) {
        require(__DIR__ . "/../view/no-encontrado.php");
        return;
    }
}

if (hayMensajes()) {
    mostrarMensajes();
}

// Mostramos el contenido html de la página
require(__DIR__ . "/view/editar.php");

// Mostramos el contenido html del footer.
require_once(__DIR__ . "/../view/footer.php");