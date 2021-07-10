<?php

class Controller
{
    protected function view(string $view) : int
    {
        $path = str_replace('%.%', DIRECTORY_SEPARATOR, $view);

        return require_once "app/Views/{$path}.php";
    }
}