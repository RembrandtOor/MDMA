<?php
require_once __DIR__.'/../Helpers/Database.php';

class Model {
    private static $query;
    private static $database;
    private static $tableName;

    private function __construct($data = []) {
        // var_dump($data);
        foreach($data as $key => $value) {
            $this->$key = $value;
        }
    }

    public static function __constructStatic() {
        self::$database = new Database();
        self::$tableName = strtolower(get_called_class()).'s';
    }

    public static function all() {
        self::__constructStatic();
        $models = [];
        $rows = self::$database->read('SELECT * FROM '.self::$tableName);
        foreach($rows as $row) {
            $models[] = new self($row);
        }
        return $models;
    }

    public static function find($id) {
        self::__constructStatic();
        return self::$database->read('SELECT * FROM '.self::$tableName.' WHERE id='.$id);
    }

    public static function where($column, $value) {
        self::__constructStatic();
        if(strlen(self::$query) == 0) {
            self::$query = 'SELECT * FROM '.self::$tableName;
        }
        self::$query .= " WHERE {$column}={$value}";
        return new self;
    }

    public static function first() {
        self::__constructStatic();
        return self::$database->read('SELECT * FROM '.self::$tableName.' ORDER BY id ASC LIMIT 1');
    }

    public static function last() {
        self::__constructStatic();
        return self::$database->read('SELECT * FROM '.self::$tableName.' ORDER BY id DESC LIMIT 1');
    }

    public static function get() {
        self::__constructStatic();
        // echo 'GETTING, QUERY='.self::$query.'<br><br>';
        $models = [];
        $rows = self::$database->read(self::$query);
        foreach($rows as $row) {
            $models[] = new self($row);
        }
        return $models;
    }
}