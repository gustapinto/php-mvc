<?php

namespace Framework;

use PDO;

class Model
{
    protected $pdo;

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
        foreach ($data as $key => $value) {
            $keys[] = $key;
            $values[] = $value;
        }

        $keysString = implode(', ', $keys);
        $valuesString = implode("','", $values);

        $queryString = "INSERT INTO `{$this->table}` (${keysString}) VALUES ('${valuesString}')";

        $this->transactionQuery($queryString);
    }

    public function read(string|null $where = null)
    {
        $whereString = is_null($where) ? '' : "WHERE ${where}";

        $queryString = "SELECT * FROM `{$this->table}` ${whereString}";

        $results = $this->pdo->query($queryString)->fetchAll();

        return $results;
    }

    public function update(array $data, string|null $where = null)
    {
        foreach ($data as $key => $value) {
            $values[] = "${key}='${value}'";
        }

        $valuesString = implode("','", $values);

        $whereString = is_null($where) ? '' : "WHERE ${where}";

        $queryString = "UPDATE `{$this->table}` SET ${valuesString} ${whereString}";

        $this->transactionQuery($queryString);
    }

    public function delete(string|null $where = null)
    {
        $whereString = is_null($where) ? '' : "WHERE ${where}";

        $queryString = "DELETE FROM `{$this->table}` ${whereString}";

        $this->transactionQuery($queryString);
    }

    public function query(string $queryString)
    {
        return $this->transactionQuery($queryString);
    }

    private function transactionQuery(string $queryString)
    {
        try {
            $this->pdo->beginTransaction();

            $this->pdo->query($queryString);

            $this->pdo->commit();
        } catch (PDOException $e) {
            $this->pdo->rollback();

            throw $e;
        }
    }
}
