<?php
namespace App\Helpers;

class Request {
    private $data;
    
    public function __construct(array $values = []) {
        foreach($_REQUEST as $key => $value) {
            $values[$key] = $value;
        }
        $this->data = $values;
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

    /**
     * Validate request and get specific values
     * @param array $rules
     * @return array
     */
    // public function validate(array $rules) {
    //     foreach($rules as $key => $value) {
    //         $this->data[$key]
    //     }
    // }
}