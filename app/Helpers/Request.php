<?php
namespace App\Helpers;

class Request {
    public function __construct($values = []) {
        foreach($values as $key => $value) {
            $this->$key = $this->cleanValue($value);
        }
    }

    private function cleanValue($value) {
        return preg_replace("/[^a-zA-Z]/", "", $value);
    }
}