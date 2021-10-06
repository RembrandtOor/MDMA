<?php
namespace App\Helpers;

use App\Models\User;

class Auth {
    public static function user(){
        return new User($_SESSION);
    }

    public static function login($user): bool {
        if($user == null) {
            return false;
        }

        foreach($user->data as $key => $value) {
            $_SESSION[$key] = $value;
        }
        $_SESSION['loggedIn'] = true;
        return true;
    }

    public static function logout() {
        $_SESSION = [];
        return session_destroy();
    }

    public static function check(): bool {
        if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true) {
            return true;
        }
        return false;
    }
}