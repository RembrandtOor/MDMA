<?php
namespace App\Helpers;

use App\Helpers\Database;

class Table {
    private static $database;

    public static function __constructStatic() {
        self::$database = new Database();
    }

    public static function create(string $table_name, array $columns) {
        $query = 'CREATE TABLE '.$table_name.' (';
            foreach($columns as $column_name => $column) {
                $query .= $column_name.' ';
                foreach($column as $option) {
                    $query .= $option.' ';
                }
                if($column != array_key_last($columns)) {
                    $query .= ',';
                }
            }
        $query .= ')';
    }
}