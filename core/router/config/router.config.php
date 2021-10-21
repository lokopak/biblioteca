<?php

namespace Library\Core\Router;


return [
    'host' => "biblioteca",
    'routes' => [
        'home' => [
            'route' => '/',
            'path' => '/home/controller/IndexController.php',
            'controller' => \Library\Pages\Home\IndexController::class,
            'action' => 'index'
        ]
    ],
];