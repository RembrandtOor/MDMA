<?php
namespace App\Helpers;

class Request {
    public function __construct() {
        $values = $_REQUEST;
        
        foreach($values as $key => $value) {
            $this->$key = $this->cleanValue($value);
        }
    }

    /**
     * Remove weird shit from value
     * @param string $value
     * @return string
     */
    private function cleanValue(string $value) {
        // return preg_replace("/[^a-zA-Z]/", "", $value);
        return $value;
    }
}