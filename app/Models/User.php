<?php
namespace App\Models;

class User extends Model {
    protected $hidden = [
        'password'
    ];

    public function getName() {
        return $this->name;
    }
}