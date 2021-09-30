<?php
namespace App\Controllers;

use App\Models\User;

class LoginController {
    
    public $userName;
    private $password;

    public function auth($request) {
        $request->username;
        $request->password;
        User::where("username", $username)->get();n

    }    
    public function index() {
        return view('login');
    }
}