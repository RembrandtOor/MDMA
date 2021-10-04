<?php
namespace App\Models;

use App\Helpers\Database;

class Model {
    private static $query;
    private static $database;
    private static $tableName;
    private static array $values = [];

    /**
     *  Create the model, set given parameters as variables;
     * @param array $data
     */
    private function __construct(array $data = []) {
        foreach($data as $key => $value) {
            $this->$key = $value;
        }
    }

    /**
     * Custom static construct, creates model and sets values needed in other functions
     */
    public static function __constructStatic() {
        self::$database = new Database();
        $splitted_name = explode('\\', strtolower(get_called_class()));
        self::$tableName = end($splitted_name).'s';
        if(strlen(self::$query) == 0) {
            self::$query = 'SELECT * FROM '.self::$tableName;
        }
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

    public static function allJSON() {
        self::__constructStatic();
        $rows = self::$database->read('SELECT * FROM '.self::$tableName);
        return json_encode($rows);
    }

    /**
     * Finds row by id and return model of kind
     * @param int $id
     * @return static|null $self
     */
    public static function find($id) {
        self::__constructStatic();
        self::$query .= " WHERE id=:id";

        $model = null;
        $search = self::$database->readOne(self::$query, [':id' => intval($id)]);
        if($search != null) {
            $model = new static($search);
        }

        return $model;
    }

    /**
     * Add where select to sql query
     * @param string $column
     * @param string $arg delimiter like >= or <= OR search value
     * @param string|null $arg2 optional
     * @return self
     */
    public static function where(string $column, string $arg, string $arg2 = null) {
        self::__constructStatic();
        $value = $arg;
        $delimiter = '=';
        if($arg2 != null) {
            $value = $arg2;
            $delimiter = $arg;
        }

        $nr = mt_rand(0, 1000000);
        $statement = 'WHERE';
        if(strpos(self::$query, $statement) !== false) {
            $statement = 'AND';
        }

        self::$query .= " $statement :column$nr :delimiter$nr :value$nr";
        self::$values[':column'.$nr] = $column;
        self::$values[':delimiter'.$nr] = $delimiter;
        self::$values[':value'.$nr] = $value;

        return new self;
    }

    /**
     * Select first column from where clause.
     * @param string $column
     * @param string $arg delimiter like >= or <= OR search value
     * @param string|null $arg2 optional
     * @return object App\Models\Model
     */
    public static function firstWhere(string $column, string $arg, string $arg2 = null) {
        self::__constructStatic();
        self::where($column, $arg, $arg2);
        var_dump(self::get());
    }

    /**
     * Add limit to sql query
     * @param int $limit
     * @return self
     */
    public static function limit(int $limit) {
        self::__constructStatic();
        self::$query .=  ' LIMIT :limit';
        self::$values[':limit'] = $limit;

        // self::$values.= [
        //     self::$values,':limit' => $limit
        // ];
        return new self;
    }

    /**
     * Select first row of result
     * @param string $column column to sort by, default is 'id'
     * @return static
     */
    public static function first(string $column = 'id') {
        self::__constructStatic();
        self::$query .=  ' ORDER BY id ASC LIMIT 1';
        return new static(self::$database->readOne(self::$query, self::$values));
    }

    /**
     * Select last row of result
     * @param string $column column to sort by, default is 'id'
     * @return static
     */
    public static function last() {
        self::__constructStatic();
        self::$query .=  ' ORDER BY `id` DESC LIMIT 1';
        return new static(self::$database->readOne(self::$query));
    }

    /**
     * Run sql query and get a collection of all rows
     * @return static
     */
    public static function get() {
        self::__constructStatic();
        $models = [];
        $rows = self::$database->read(self::$query, self::$values);
        foreach($rows as $row) {
            $models[] = new static($row);
        }
        return $models;
    }

    public static function getJSON() {
        self::__constructStatic();
        $rows = self::$database->read(self::$query, self::$values);
        return json_encode($rows);
    }

    public static function create(array $values = []) {
        self::__constructStatic();

        $query = 'INSERT INTO '.self::$tableName. ' (';
            foreach($values as $key => $value) {
                $query .= '`'.$key.'`';
                if($key != array_key_last($values)) {
                    $query .= ', ';
                }
            }
        $query .= ') VALUES (';
            foreach($values as $key => $value) {
                $query .= ':'.$key;
                if($key != array_key_last($values)) {
                    $query .= ', ';
                }
            }
        $query .= ')';

        foreach($values as $key => $value) {
            $values[':'.$key] = $value;
            unset($values[$key]);
        }

        $id = self::$database->create($query, $values);

        return self::find($id);
    }
}