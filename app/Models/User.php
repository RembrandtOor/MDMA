<?php
namespace App\Models;

class User extends Model {
    public function getName() {
        return $this->name;
    }
}