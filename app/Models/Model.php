<?php
namespace App\Models;

use App\Helpers\Database;

class Model {
    private static $query;
    private static $database;
    private static $tableName;

    /**
     *  Create the model, set given parameters as variables;
     * @param array $data
     */
    private function __construct($data = []) {
        foreach($data as $key => $value) {
            $this->$key = $value;
        }
    }

    /**
     * Custom static construct, creates model and sets values needed in other functions
     */
    public static function __constructStatic() {
        if(strlen(self::$query) == 0) {
            self::$query = 'SELECT * FROM '.self::$tableName;
        }
        self::$database = new Database();
        $splitted_name = explode('\\', strtolower(get_called_class()));
        self::$tableName = end($splitted_name).'s';
    }

    /**
     * Select all models of kind
     * @return array $models
     */
    public static function all() {
        self::__constructStatic();
        $models = [];
        $rows = self::$database->read('SELECT * FROM '.self::$tableName);
        foreach($rows as $row) {
            $models[] = new static($row);
        }
        return $models;
    }

    /**
     * Finds row by id and return model of kind
     * @param int $id
     * @return static $self
     */
    public static function find(int $id) {
        self::__constructStatic();
        self::$query .=  ' WHERE id='.$id;
        return new self(self::$database->readOne(self::$query));
    }

    /**
     * Add where select to sql query
     * @param string $column
     * @param string $arg delimiter like >= or <= OR search value
     * @param string $arg2 optional
     * @return self
     */
    public static function where(string $column, string $arg, string $arg2 = null) {
        self::__constructStatic();
        if($arg2 == null) {
            $value = $arg;
            $delimiter = '=';
        } else {
            $delimiter = $arg;
            $value = $arg2;
        }
        self::$query .= " WHERE {$column}{$delimiter}{$value}";
        return new self;
    }

    /**
     * Add limit to sql query
     * @param int $limit
     * @return self
     */
    public static function limit(int $limit) {
        self::__constructStatic();
        self::$query .=  ' LIMIT '.$limit;
        return new self;
    }

    /**
     * Select first row of result
     * @param string $column column to sort by, default is 'id'
     * @return static
     */
    public static function first($column = 'id') {
        self::__constructStatic();
        self::$query .=  ' ORDER BY id ASC LIMIT 1';
        return new static(self::$database->readOne(self::$query));
    }

    /**
     * Select last row of result
     * @param string $column column to sort by, default is 'id'
     * @return static
     */
    public static function last() {
        self::__constructStatic();
        self::$query .=  ' ORDER BY id DESC LIMIT 1';
        return new static(self::$database->readOne(self::$query));
    }

    /**
     * Run sql query and get a collection of all rows
     * @return static
     */
    public static function get() {
        self::__constructStatic();
        $models = [];
        $rows = self::$database->read(self::$query);
        foreach($rows as $row) {
            $models[] = new static($row);
        }
        return $models;
    }
}