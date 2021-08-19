<?php

use Framework\Router;

use App\Controllers\IndexController;
use App\Controllers\ProductsController;

$router = new Router();

$router->register('', IndexController::class, 'index', 'GET');

$router->register('/products', ProductsController::class, 'index', 'GET');
$router->register('/products/new', ProductsController::class, 'new', 'POST');

$router->run($router->method(), $router->url());
