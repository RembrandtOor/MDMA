<?php
require_once __DIR__.'../Helpers/Database.php';

class Model {
    static $database;
    static $table;

    public function __construct() {
        // $this->table = __FILE__.'s';
        // $this->database = new Database();
        self::$database = new Database();
        self::$table = __FILE__.'s';
    }

    // public function all() {
    //     $this->database->read("SELECT * FROM {$this->table}");
    // }

    public static function all() {
        $a = self::$table;
        self::$database->read("SELECT * FROM {$a}");
    }
}
