<?php
namespace App\Controllers\Auth;

use App\Models\User;
use App\Helpers\Request;

class RegisterController {
    public function register(Request $request) {
        if(User::firstWhere('username', $request->username)() != null) {
            return response()->json([
                'success' => false, 
                'error' => 'Username already in use'
            ]);
        } 

        return response()->json(['test' => 'yes']);
        

        // $user = User::where("username", $this->username)->get();
        // $password = User::where("password", $this->password)->get();
    }
        
    public function index() {
        return view('register');
    }
}