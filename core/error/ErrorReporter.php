<?php

namespace Library\Core\Error;

require_once(__DIR__ . "/../service/ServiceInterface.php");

use Library\Core\Service\ServiceInterface;

class ErrorReporter implements ServiceInterface
{
    /**
     * Variable global donde se guardarán los errores que surjan durante la ejecución de
     * la aplicación y que serán mostrados una vez termine.
     */
    protected $errores = [];

    /**
     * The uniq instance of this class
     */
    protected static $instance = null;

    /**
     * Constructor
     */
    private function __construct()
    {
    }

    /**
     * Returns the instance
     * 
     * @return \Library\Core\Error\ErrorReporter
     */
    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new ErrorReporter();
        }

        return self::$instance;
    }

    /**
     * Agrega un nuevo error a la lista de errores a mostrar.
     * 
     * @param string $mensaje Un string con el mensaje del error.
     * @param string $tipo Un string con el tipo de error. Será el título
     *                    del error.
     *  - Por ejemplo: "Error en SQL", "Error en datos".... 
     * 
     * @return void No devuelve ningún valor.
     */
    public function agregarError($mensaje, $tipo)
    {
        // Recogemos en el array el mensaje y el tipo del error
        $error["mensaje"] = $mensaje;
        $error["tipo"] = $tipo;

        // Agregamos el array con los datos del error al array global de errores.
        // Si no se le indica un índice cuando se asignan valores a un array, se genera un nuevo índice al final del array.
        $this->errores[] = $error;
    }

    /**
     * Devuelve true si hay errores para mostrar
     * o false si no hay ningún error para mostrar.
     * 
     * @return void No devuelve ningún valor.
     */
    public function hayErrores()
    {

        // Devuelve el resultado de la comparación '>' (mayor que)
        return count($this->errores) > 0;
    }

    /**
     * Muestra los errores encontrados. Una vez
     * se han mostrado. Los borra para la siguiente,
     * ejecución de la aplicacion.
     * 
     * @return void No devuelve ningún valor.
     */
    public function mostrarErrores()
    {
        // Si hay errores para mostrar los agrega al html.
        if ($this->hayErrores()) {

            // Mostramos el html de los errores
            require(__DIR__ . "./view/errores.php");

            // Vaciamos los errores
            $this->errores = [];
        }
    }
}