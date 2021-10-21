<?php

namespace Library\Core\Service;

use Exception;

class ServiceManager
{

    /**
     * Instance of this Manager
     * @var \Library\Core\Service\ServiceManager
     */
    protected static $instance;

    /**
     * Services instances.
     * @var \Library\Core\Service\ServiceInterface[]
     */
    protected $services = [];

    /**
     * 
     */
    private function __construct()
    {
    }

    /**
     * Returns the uniq instance of this Manager.
     * 
     * @return \Library\Core\Service\ServiceManager
     */
    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new ServiceManager();
        }

        return self::$instance;
    }

    /**
     * Return a service instance if exists
     * 
     * @return \Library\Core\Service\ServiceInterface
     */
    public function getService($serviceName)
    {
        $service = null;
        if (isset($this->services[$serviceName])) {
            $service = $this->services[$serviceName];
        }

        return $service;
    }

    /**
     * Adds a service interface instance to this manager.
     * 
     * @param \Library\Core\Service\ServiceInterface
     * 
     * @return void
     */
    public function addService($serviceName, $service)
    {
        if (in_array($serviceName, $this->services)) {
            throw new Exception("The service {$serviceName} if already registered.");
        }

        $this->services[$serviceName] = $service;
    }
}