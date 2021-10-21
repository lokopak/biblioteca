<?php

namespace Library\Http;

class Request
{
    /**
     * Comprueba que la petición (request) se ha hecho
     * mediante un método POST.
     * 
     * @return boolean El resultado de la comprobación.
     */
    public function esPost()
    {
        return ($_SERVER["REQUEST_METHOD"] === "POST");
    }

    /**
     * Obteiene un parámetro desde el GET.
     * En caso de no existir dicho parámetro
     * devuelve un valor por defecto.
     * 
     * @param string $nombre El nombre del parámetro.
     * @param mixed $porDefecto El valor a devolver por defecto.
     * 
     * @return mixed
     */
    public function obtenerDesdePost($nombre, $porDefecto)
    {
        if (isset($_POST[$nombre])) {
            return $_POST[$nombre];
        }

        return $porDefecto;
    }

    /**
     * Obteiene un parámetro desde el GET.
     * En caso de no existir dicho parámetro
     * devuelve un valor por defecto.
     * 
     * @param string $nombre El nombre del parámetro.
     * @param mixed $porDefecto El valor a devolver por defecto.
     * 
     * @return mixed
     */
    public function obtenerDesdeGet($nombre, $porDefecto)
    {
        if (isset($_GET[$nombre])) {
            return $_GET[$nombre];
        }

        return $porDefecto;
    }
}