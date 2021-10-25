<?php
namespace App\Models;

class Artist extends Model {
    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }
}