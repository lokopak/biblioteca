<?php

namespace Library\Core\Controller;

abstract class AbstractController
{

    /**
     * Service manager
     * 
     * @var \Library\Core\Service\ServiceManager
     */
    protected $serviceManager;

    /**
     * Constructor
     * 
     * @param \Library\Core\Service\ServiceManager
     */
    public function __construct($serviceManager)
    {
        $this->serviceManager = $serviceManager;
    }
}