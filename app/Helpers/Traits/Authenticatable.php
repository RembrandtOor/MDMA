<?php

namespace App\Helpers\Traits;

trait Authenticatable {
    public function passwordMatch(string $password): bool {
        if(password_verify($password, $this->password)) {
            return true;
        }
        return false;
    }
}