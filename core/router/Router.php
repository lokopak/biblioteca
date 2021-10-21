<?php

declare(strict_types=1);

namespace Library\Core\Router;

use Exception;
use Library\Core\Service\ServiceManager;

/**
 * Router class handles the routes of the entire application.
 */
class Router
{
    /**
     * Array containing all application routes.
     * @var array
     */
    protected $routes = [];

    /**
     * Service manager to inject into route controllers.
     * 
     * @var \Library\Core\Service\ServiceManager
     */
    protected $manager;

    /**
     * Unique instance of Router class.
     * @var \Library\Core\Router\Router
     */
    protected static $instance;

    /**
     * Constructor
     * 
     * @param \Library\Core\Service\ServiceManager $manager
     * @param array $config Array with routes configuration
     */
    private function __construct(ServiceManager $manager, array $config)
    {
        $this->manager = $manager;
        // If empty, nothing to do.
        if (empty($config)) {
            return;
        }

        // Load all routes
        // @TODO : parse and validate routes.
        if (isset($config['routes'])) {
            $this->routes = $config['routes'];
        }
    }

    /**
     * Returns the unique Router instance.
     * This creates it if it's not created yet
     * 
     * @return \Library\Core\Router\Router
     */
    public static function getRouter($manager)
    {
        // Create the instance if it's not created yet.
        if (!self::$instance) {
            self::$instance = self::createInstance($manager);
        }

        return self::$instance;
    }

    /**
     * Generates a new Router instance.
     * 
     * @return \Library\Core\Router\Router
     */
    protected static function createInstance($manager)
    {
        if (self::$instance) {
            return;
        }
        $config = [];

        $config = array_merge(include __DIR__ . "/config/router.config.php");

        return new Router($manager, $config);
    }

    /**
     * Returns an array with all routes.
     * 
     * @return array
     */
    public function getRoutes()
    {
        return $this->routes;
    }

    /**
     * Load all routes from config.
     * 
     * @return void
     */
    public function loadRotes()
    {
        $this->config = array_merge(include __DIR__ . "/config/router.config.php");

        // No routes found
        if (empty($this->config['routes'])) {
            return;
        }

        foreach ($this->config['routes'] as $key => $data) {
            $this->add($key, $data);
        }
    }

    /**
     * Adds a given route to the route list.
     * 
     * @param string $name The route name as identifier
     * @param array $data All route parameters.
     * 
     * @return void
     */
    public function add($name, $data)
    {
        if (empty($data['route']) || empty($data['controller']) || empty($data['action'])) {
            throw new Exception('Invalid route schema.');
        }

        $this->routes[$name] = $data;
    }

    /**
     * Execute router to filter the current uri
     * and display corresponding page.
     * 
     * @param \Library\Core\Service\ServiceManager
     * 
     * @return void
     */
    public function run()
    {
        $uriGet = isset($_SERVER['REQUEST_URI']) ? '/' . $_SERVER['REQUEST_URI'] : '/';

        foreach ($this->routes as $key => $value) {
            $route = $value['route'];

            if (preg_match("#^$route$#", $uriGet)) {
                $controller = $value['controller'];
                $action = $value['action'];
                $path = __DIR__ . '/../../pages' . $value['path'];
                if (file_exists($path)) {
                    require_once($path);
                    return $this->runAction($controller, $action);
                } else {
                    // Mensaje de error.
                    return;
                }
            }
        }

        return require_once(__DIR__ . '/../view/no-encontrado.php');
    }

    private function runAction($controller, $action)
    {
        if ($action instanceof \Closure) {
            return $action();
        } else {
            $obj = new $controller($this->manager);
            return $obj->{$action}();
        }

        return false;
    }
}