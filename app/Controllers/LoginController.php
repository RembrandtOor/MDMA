<?php
namespace App\Controllers;

use App\Models\User;

class LoginController {
    
    private $userName;
    private $password;

    public function login($request) {

        $this->username = $request->username;
        $this->password = $request->password;

        $user = User::where("username", $this->username)->get();
        $password = User::where("password", $this->password)->get();
    }
        
    public function index() {
        return view('login');
    }
}