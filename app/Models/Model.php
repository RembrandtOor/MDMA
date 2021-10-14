<?php
namespace App\Models;

use App\Helpers\Database;

class Model {
    private static $query;
    private static $database;
    private static $tableName;
    private static $values = [];
    public $data = [];

    /**
     *  Create the model, set given parameters as variables;
     * @param array $data
     */
    public function __construct(array $data = []) {
        foreach($data as $key => $value) {
            $this->$key = $value;
            if(isset($this->hidden) && !in_array($key, $this->hidden)) {
                $this->data[$key] = $value;
            }
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
            $models[] = self::return($row);
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
            $model = self::return($search);
        }

        self::$query = '';

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

        $statement = 'WHERE';
        if(strpos(self::$query, $statement) !== false) {
            $statement = 'AND';
        }

        self::$query .= " $statement $column $delimiter ?";
        self::$values[] = $value;

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
        return self::first();
    }

    /**
     * Add limit to sql query
     * @param int $limit
     * @return self
     */
    public static function limit(int $limit) {
        self::__constructStatic();
        self::$query .=  ' LIMIT ?';
        self::$values[] = $limit;

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
        self::$query .= " ORDER BY `$column` ASC LIMIT 1";
        $model = self::return(self::$database->readOne(self::$query, self::$values));
        self::$query = '';
        return $model;
    }

    /**
     * Select last row of result
     * @param string $column column to sort by, default is 'id'
     * @return static
     */
    public static function last(string $column = 'id') {
        self::__constructStatic();
        self::$query .= " ORDER BY `$column` DESC LIMIT 1";
        $model = self::return(self::$database->readOne(self::$query, self::$values));
        self::$query = '';
        return $model;
        // self::orderByDesc($column);
        // return self::limit(1);
    }

    public static function orderBy(string $column) {
        self::$query .= "ORDER BY `$column` ASC";
        return new self;
    }

    public static function orderByDesc(string $column) {
        self::$query .= "ORDER BY `$column` DESC";
        return new self;
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
            $models[] = self::return($row);
        }
        self::$query = '';
        return $models;
    }

    public static function getJSON() {
        self::__constructStatic();
        $rows = self::$database->read(self::$query, self::$values);
        self::$query = '';
        return json_encode($rows);
    }

    public static function create(array $values) {
        self::__constructStatic();

        $query = 'INSERT INTO '.self::$tableName. ' (';
            foreach($values as $key => $value) {
                $query .= "`$key`";
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

        self::$query = '';

        return self::find($id);
    }

    public static function update(array $values) {
        self::__constructStatic();

        $query = 'UPDATE '.self::$tableName. ' SET ';
            foreach($values as $key => $value) {
                $query .= "`$key`=:$key";
                if($key != array_key_last($values)) {
                    $query .= ', ';
                }
            }
        $query .= ' WHERE id = :id';

        foreach($values as $key => $value) {
            $values[':'.$key] = $value;
            unset($values[$key]);
        }
        $values[':id'] = self::$values['id'];

        $data = self::$database->update($query, $values);
        self::$query = '';
        return $data;
    }

    public static function count(string $column = '*') {
        self::__constructStatic();
        self::$query = str_replace('*', "COUNT($column) as count", self::$query);
        $count = self::$database->readOne(self::$query, self::$values)['count'];
        self::$query = '';
        return $count;
    }

    private static function return($model) {
        return $model ? new static($model) : null;
    }

    /**
     * Model relationships
     */

    // public function belongsTo(object $model, string $column = 'id') {

    // }
}