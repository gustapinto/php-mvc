<?php

namespace Framework;

class Controller
{
    protected function view(string $view)
    {
        // Get the view name as 'dir.view' and convert it to a valid system
        // system directory, ex: 'dir/view' on UNIX or 'dir\view' on windows
        $path = str_replace('%.%', DIRECTORY_SEPARATOR, $view);

        return require_once "app/Views/{$path}.php";
    }
}
