<?php

namespace Library\Pages\Home;

require_once(__DIR__ . "/../../../core/controller/AbstractController.php");

use Library\Core\Controller\AbstractController;
use Library\Core\Error\ErrorReporter;
use Library\Core\Messenger\Messenger;

class IndexController extends AbstractController
{
    public function index()
    {
        $errorReporter = $this->serviceManager->getService(ErrorReporter::class);
        $messenger = $this->serviceManager->getService(Messenger::class);
        return require(__DIR__ . "/../view/index.php");
    }
}