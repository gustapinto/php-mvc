<?php

// Declare the Namespace x Class Path relation array
$namespaces = [
    'App\\' => 'app',
    'Framework\\' => 'framework',
];

foreach ($namespaces as $namespace => $classpaths) {
    spl_autoload_register(function($classname) use ($namespace, $classpaths) {
        // Treat all $classpaths as a array
        if (! is_array($classpaths)) {
            $classpaths = [$classpaths];
        }

        // Check if the namespace matches the Class name
        if (preg_match('#^'.preg_quote($namespace).'#', $classname)) {
            // Removes the namespace from the required Class, and make a file
            // name using it
            $classname = str_replace($namespace, '', $classname);
            $filename = preg_replace('#\\\#', DIRECTORY_SEPARATOR, $classname) . '.php';

            foreach ($classpaths as $classpath) {
                // Uses the Class path and file name to build a fully qualified
                // file path, then checks if teh file exists, if true require it
                $filepath = __DIR__ . DIRECTORY_SEPARATOR . $classpath . DIRECTORY_SEPARATOR . $filename;

                if (file_exists($filepath)) {
                    require_once $filepath;
                }
            }
        }
    });
}
