<?php

$namespaces = [
    'App\\' => 'app/',
    'Framework\\' => 'framework/',
];

foreach ($namespaces as $namespace => $classpaths) {
    spl_autoload_register(function($classname) use ($namespace, $classpaths) {
        if (! is_array($classpaths)) {
            $classpaths = [$classpaths];
        }

        // Check if the namespace matches the class name
        if (preg_match('#^'.preg_quote($namespace).'#', $classname)) {
            // Removes the namespace from the required class
            $classname = str_replace($namespace, '', $classname);
            $filename = preg_replace('#\\\#', DIRECTORY_SEPARATOR, $classname) . '.php';

            foreach ($classpaths as $classpath) {
                $filepath = __DIR__ . DIRECTORY_SEPARATOR . $classpath . DIRECTORY_SEPARATOR . $filename;

                if (file_exists($filepath)) {
                    require_once $filepath;
                }
            }
        }
    });
}
