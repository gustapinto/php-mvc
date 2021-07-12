<?php

namespace Framework;

use PDO;

class Model
{
    protected $pdo;

    // Create the $table as a global variable, which will be populated on Models
    protected $table;

    public function __construct()
    {
        $host = getenv('DB_HOST');
        $port = getenv('DB_PORT');
        $database = getenv('DB_DATABASE');
        $username = getenv('DB_USER');
        $password = getenv('DB_PASSWORD');

        $dsn = "mysql:host=${host};port=${port};dbname=${database}";

        // Initialize the PDO connection
        $this->pdo = new PDO($dsn, $username, $password);

        // Configure the PDO's fetch to return a object
        $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    }

    public function create(array $data)
    {
        // Create a new array with only the keys from $data and use it to create
        // a valid SQL table columns string
        $keys = array_keys($data);
        $keysString = implode(', ', $keys);

        // Create a new array with only the values form $data, and use it to make
        // a valid SQL value assign string
        $values = array_values($data);
        $valuesString = implode("','", $values);

        $queryString = "INSERT INTO `{$this->table}` (${keysString}) VALUES ('${valuesString}')";

        $this->exec($queryString);
    }

    public function read(string|null $where = null)
    {
        $whereString = is_null($where) ? '' : "WHERE ${where}";

        $queryString = "SELECT * FROM `{$this->table}` ${whereString}";

        $results = $this->query($queryString)->fetchAll();

        return $results;
    }

    public function update(array $data, string|null $where = null)
    {
        // Create a array containing a $key='$value' strings
        foreach ($data as $key => $value) {
            $values[] = "${key}='${value}'";
        }

        $valuesString = implode("','", $values);

        $whereString = is_null($where) ? '' : "WHERE ${where}";

        $queryString = "UPDATE `{$this->table}` SET ${valuesString} ${whereString}";

        $this->exec($queryString);
    }

    public function delete(string|null $where = null)
    {
        $whereString = is_null($where) ? '' : "WHERE ${where}";

        $queryString = "DELETE FROM `{$this->table}` ${whereString}";

        $this->exec($queryString);
    }

    public function query(string $queryString)
    {
        return $this->pdo->query($queryString);
    }

    public function exec(string $queryString)
    {
        return $this->pdo->exec($queryString);
    }
}
