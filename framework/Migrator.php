<?php

namespace Framework;

class Migrator
{
    protected $migrations;

    public function __construct()
    {
        // The array_diff removes . and .. entries from scandir result
        $this->migrations = array_diff(scandir('migrations/'), array('..', '.'));
    }

    public function migrate()
    {
        return $this->run('up');
    }

    public function rollback()
    {
        return $this->run('down');
    }

    private function run(string $action)
    {
        $model = new Model();

        foreach ($this->migrations as $migrationFileName) {
            // Removes the .php from migration file name to use it as class name
            $migrationClass = str_replace('.php', '', $migrationFileName);

            $migrationClassWithNamespace = "\Migrations\\${migrationClass}";

            $migration = new $migrationClassWithNamespace();

            $queryString = $migration->$action();

            $model->exec($queryString);
        }
    }
}
