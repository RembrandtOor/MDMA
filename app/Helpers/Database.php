<?php
namespace App\Helpers;

class Database {
    public function __construct($host = '127.0.0.1:3306', $database = 'mdma', $username = 'root', $password = 'password', $type = 'mysql') {
        $this->conn = $this->construct($host, $database, $username, $password, $type);
    }

    private function construct(string $host = '127.0.0.1:3306', string $database = 'mdma', string $username = 'root', string $password = 'password', string $type = 'mysql') {
        try {
            $pdo = new \PDO("{$type}:host={$host};dbname=$database", $username, $password);
            $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_WARNING);
        } catch (\PDOException $e) {
            throw new \PDOException($e->getMessage());
        }

        return $pdo;
    }

    public function read(string $query, array $parameters = []) {
        $conn = $this->construct();
        
        try {
            $prepared = $conn->prepare($query);
            $prepared->execute($parameters);
        } catch (\PDOException $e) {
            echo 'Something wrong with a query<br>';
            var_dump($query, $parameters);
            echo $e->getMessage();
        }

        return $prepared->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function readOne(string $query, array $parameters = []) {
        $conn = $this->construct();
        
        try {
            $prepared = $conn->prepare($query);
            $prepared->execute($parameters);
        } catch (\PDOException $e) {
            echo 'Something wrong with a query<br><br>';
            var_dump($query);
            echo '<br>';
            var_dump($parameters);
            echo '<br>';
            echo $e->getMessage();
            echo '<br><br>';
        }
        $stuff = $prepared->fetch(\PDO::FETCH_ASSOC);
        var_dump($stuff);
        return $stuff;
    }

    public function create(string $query, array $parameters = []) {
        $conn = $this->construct();
        
        try {
            $prepared = $conn->prepare($query);
            $prepared->execute($parameters);
            return $conn->lastInsertId();
        } catch (\PDOException $e) {
            echo 'Something wrong with a query<br>';
            echo $e->getMessage();
            return false;
        }
    }
}