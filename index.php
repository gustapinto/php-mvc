<?php

// Get the URL path without using a $_GET['htaccess_key'] approach
$path = "{$_SERVER['REQUEST_URI']}/";

$separator = explode('/', $path);

// In this specific example the controller will always be the first URL parameter
$controller = $separator[1] == null ? 'index' : $separator[1];
$action = $separator[2] == null ? 'index' : $separator[2];

// Converts the controller name to PascalCase, so 'index' -> 'Index'
$controller = mb_convert_case($controller, MB_CASE_TITLE, 'UTF-8');

// Add the Controller suffix to the desired controller name
$controller = "${controller}Controller";

// Requires the controller based on the URL
require_once "app/Controllers/{$controller}.php";

// Instance the user desired Controller and call for the action method
$app = new $controller();

$app->$action();
