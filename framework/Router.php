<?php

namespace Framework;

class Router
{
    protected $routes = [];

    public function url()
    {
        // Get the URL path without using a $_GET['htaccess_key'] approach
        return $_SERVER['REQUEST_URI'] . '/';
    }

    public function method()
    {
        // Get the request method
        return $_SERVER['REQUEST_METHOD'];
    }

    public function register(string $uri, string $controller, string $action, string $method)
    {
        $method = strtolower($method);

        $this->routes[$method][$uri] = function() use ($controller, $action) {
            return (new $controller())->$action();
        };
    }

    public function run(string $method, string $uri)
    {
        // Converts the method to lower case to prevent non uppercase method
        // names when defining routes using t
        $method = strtolower($method);

        // This removes the last '/' of the string, thus preventing a url not
        // found error
        $uri = (strlen($uri) > 1) ? rtrim($uri, '/') : $uri;

        foreach($this->routes[$method] as $route => $callback) {
            if ($route === $uri) {
                return $callback();
            }
        }
    }
}
