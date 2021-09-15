<?php

class Database {
    public function __construct($host = '127.0.0.1:3306', $database = 'mdma', $username = 'root', $password = '', $type = 'mysql') {
        $this->conn = $this->construct($host, $database, $username, $password, $type);
    }

    private function construct($host = '127.0.0.1:3306', $database = 'mdma', $username = 'root', $password = '', $type = 'mysql') {
        return new PDO("{$type}:host={$host};dbname=$database", $username, $password);
    }

    public function read($query, $parameters = []) {
        $conn = $this->construct();
        $prepared = $conn->prepare($query);
        $prepared->execute($parameters);

        return $prepared->fetchAll(PDO::FETCH_ASSOC);
    }
}