<?php

require_once(__DIR__ . "/core/service/ServiceManager.php");
require_once(__DIR__ . "/core/router/Router.php");
require_once(__DIR__ . "/core/error/ErrorReporter.php");
require_once(__DIR__ . "/core/message/Messenger.php");
// var_dump($_SERVER);

use Library\Core\Error\ErrorReporter;
use Library\Core\Messenger\Messenger;
use Library\Core\Router\Router;
use Library\Core\Service\ServiceManager;

// Load the global server manager.
$manager = ServiceManager::getInstance();

// Get ErrorReporter instance
$errorReporter = ErrorReporter::getInstance();
$manager->addService(ErrorReporter::class, $errorReporter);

// Get Messenger instance
$messenger = Messenger::getInstance();
$manager->addService(Messenger::class, $messenger);

// Get Router instance
$router = Router::getRouter($manager);
$manager->addService(Router::class, $router);
$router->loadRotes();
$router->run($manager);