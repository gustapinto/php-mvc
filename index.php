<?php

$path = "{$_SERVER['REQUEST_URI']}/";

$separator = explode('/', $path);

// In this specific example the controller will always be the first URL parameter
$controller = $separator[1] == null ? 'IndexController' : $separator[1];
$action = $separator[2] == null ? 'index' : $separator[2];

// Requires the controller based on the URL
require_once "app/Controllers/{$controller}.php";

$app = new $controller();

$app->$action();
