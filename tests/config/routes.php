<?php
use Cake\Routing\Router;
use Cake\Routing\RouteBuilder;

Router::prefix('admin', function (RouteBuilder $routes) {
    $routes->connect('/', [
        'controller' => 'Admin',
        'action' => 'dashboard',
        'plugin' => false,
        'admin'  => true
    ]);

    $routes->fallbacks('DashedRoute');
});
