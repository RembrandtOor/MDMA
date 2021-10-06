<?php
namespace App\Models;

use App\Helpers\Traits\Authenticatable;

class User extends Model {
    use Authenticatable;
    
    protected $hidden = [
        'password'
    ];

    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }
}