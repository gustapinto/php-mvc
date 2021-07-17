<?php

// Autoload all classes, to be independent from index.php calls
require_once '../autoload.php';

use Framework\Migrator;

if (count($argv) > 1) {
    $parameter = strtolower($argv[1]);

    factory($parameter);
} else {
    echo "Missing parameters \n\n";

    printAvailableParameters();
}

function factory(string $parameter)
{
    $migrator = new Migrator();

    switch ($parameter) {
        case 'rollback':
            $migrator->rollback();
            break;

        case 'migrate':
            $migrator->migrate();
            break;

        default:
            echo "Invalid parameter: $parameter\n\n";

            printAvailableParameters();
            break;
    }
}

function printAvailableParameters()
{
    echo "Available parameters: \n";
    echo "- migrate\n";
    echo "- rollback\n";
}
