<?php

namespace Framework;

class Controller
{
    const VIEWS_PATH = 'app' . DIRECTORY_SEPARATOR . 'Views' . DIRECTORY_SEPARATOR;

    protected function view(string $view)
    {
        // Get the view name as 'dir.view' and convert it to a valid system
        // system directory, ex: 'dir/view' on UNIX or 'dir\view' on windows
        $path = str_replace('.', DIRECTORY_SEPARATOR, $view);

        return require_once self::VIEWS_PATH . $path . '.php';
    }
}
