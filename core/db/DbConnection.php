<?php

namespace Library\Db;

use Exception;
use PDOException;

// require_once es igual que 'import' con la diferencia de que si el archivo
// no se encuentra, se devuelve un error grave y se asegura que el archivo se carga
// en la memoria una sola vez. Esto sirve para no duplicar un código que queremos
// que solo se carge una vez.
// Para evitar errores usamos __DIR__ para determinar el path real de los archivos.
require_once(__DIR__ . "/../error/error.php");


class DbConnection
{

    private $host;

    private $dbUser;

    private $dbPassword;

    private $dbName;

    private static $connection = null;

    /**
     * Constructor.
     */
    private function __construct($dbUser, $dbPassword, $dbName, $dbHost)
    {
        $this->dbUser = $dbUser;
        $this->dbPassword = $dbPassword;
        $this->dbName = $dbName;
        $this->dbHost = $dbHost;
    }

    /**
     * 
     */
    public static function getConnection()
    {
        if (!self::$connection) {
            self::createConnection();
        }

        return self::$connection;
    }

    /**
     * 
     */
    private static function createConnection()
    {
        $config = include __DIR__ . "/../config/local.php";

        if (!isset($config["database"])) {
            throw new Exception("No database configuration provided");
        }

        $dbUser = isset($config["database"]["user"]) ? $config["database"]["user"] : '';
        $dbPassword = isset($config["database"]["password"]) ? $config["database"]["password"] : '';
        $dbName = isset($config["database"]["dbname"]) ? $config["database"]["dbname"] : '';
        $dbHost = isset($config["database"]["host"]) ? $config["database"]["host"] : '';

        try {
            self::$connection = new DataBasePDO($dbUser, $dbPassword, $dbName, $dbHost);
        } catch (PDOException $e) {
            agregarError("No se pudo conectar con la base de datos: " . $e->getMessage(), "SQL ERROR");
        }
    }

    /**
     * Cierra una conexión con la base de datos.
     */
    public static function closeConnection()
    {
        // La conexión no existe o no está establecida. No hay nada que hacer.
        if (!self::$connection) {
            return;
        }

        self::$connection = null;
    }
}