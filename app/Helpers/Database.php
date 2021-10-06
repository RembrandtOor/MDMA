<?php
namespace App\Helpers;

class Database {
    public function __construct($host = '127.0.0.1:3306', $database = 'mdma', $username = 'root', $password = 'password', $type = 'mysql') {
        $this->conn = $this->construct($_ENV['DB_HOST'] ?? $host, $_ENV['DB_NAME'] ?? $database, $_ENV['DB_USERNAME'] ?? $username, $_ENV['DB_PASSWORD'] ?? $password, $type);
    }

    private function construct(string $host = '127.0.0.1:3306', string $database = 'mdma', string $username = 'root', string $password = 'password', string $type = 'mysql') {
        try {
            $pdo = new \PDO("{$type}:host={$host};dbname=$database", $username, $password);
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

    public function readOne(string $query, array $parameters = []): ?array {
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
        if($prepared->rowCount() == 0) {
            return null;
        }
        return $prepared->fetch(\PDO::FETCH_ASSOC);
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