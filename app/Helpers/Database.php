<?php
namespace App\Helpers;

class Database {
    private $conn;

    public function __construct() {
        $host = $_ENV['DB_HOST'] ?? '127.0.0.1:3306';
        $database = $_ENV['DB_NAME'] ?? 'mdma';
        $username = $_ENV['DB_USERNAME'] ?? 'root';
        $password = $_ENV['DB_PASSWORD'] ?? 'mdma';
        $type = $_ENV['DB_TYPE'] ?? 'mysql';
        try {
            $this->conn = new \PDO("{$type}:host={$host};dbname=$database", $username, $password);
        } catch (\PDOException $e) {
            throw new \PDOException($e->getMessage());
        }
    }

    public function read(string $query, array $parameters = []) {        
        try {
            $prepared = $this->conn->prepare($query);
            $prepared->execute($parameters);
        } catch (\PDOException $e) {
            echo 'Something wrong with a query<br>';
            var_dump($query, $parameters);
            echo $e->getMessage();
        }

        return $prepared->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function readOne(string $query, array $parameters = []): ?array {        
        try {
            $prepared = $this->conn->prepare($query);
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
        if($prepared->rowCount() == 0) {
            return null;
        }
        return $prepared->fetch(\PDO::FETCH_ASSOC);
    }

    public function create(string $query, array $parameters = []) {
        // $this->conn = $this->construct();
        
        try {
            $prepared = $this->conn->prepare($query);
            $prepared->execute($parameters);
            return $this->conn->lastInsertId();
        } catch (\PDOException $e) {
            echo 'Something wrong with a query<br>';
            echo $e->getMessage();
            return false;
        }
    }
}