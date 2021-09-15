<?php

class Database {
    public function __construct($host = '127.0.0.1:3306', $database = 'mdma', $username = 'root', $password = 'password', $type = 'mysql') {
        $this->conn = $this->construct($host, $database, $username, $password, $type);
    }

    private function construct($host = '127.0.0.1:3306', $database = 'mdma', $username = 'root', $password = 'password', $type = 'mysql') {
        try {
            $pdo = new PDO("{$type}:host={$host};dbname=$database", $username, $password);
        } catch (PDOException $e) {
            throw new \PDOException($e->getMessage());
        }

        return $pdo;
    }

    public function read($query, $parameters = []) {
        $conn = $this->construct();
        
        try {
            $prepared = $conn->prepare($query);
            $prepared->execute($parameters);
        } catch (PDOException $e) {
            echo 'Something wrong with a query<br>';
            var_dump($query, $parameters);
            echo $e->getMessage();
        }

        return $prepared->fetchAll(PDO::FETCH_ASSOC);
    }

    public function readOne($query, $parameters = []) {
        $conn = $this->construct();
        
        try {
            $prepared = $conn->prepare($query);
            $prepared->execute($parameters);
        } catch (PDOException $e) {
            echo 'Something wrong with a query<br>';
            var_dump($query, $parameters);
            echo $e->getMessage();
        }
        
        return $prepared->fetch(PDO::FETCH_ASSOC);
    }
}