<?php
namespace App\Controllers\Auth;

use App\Models\User;
use App\Helpers\Request;
use App\Helpers\Auth;

class RegisterController {
    public function register(Request $request) {
        if(User::firstWhere('username', $request->username) != null) {
            return response()->json([
                'success' => false, 
                'error' => 'Username already in use'
            ]);
        }

        if($request->password != $request->password_confirm) {
            return response()->json([
                'success' => false, 
                'error' => 'Passwords do not match'
            ]);
        }

        if(strlen($request->username) < 3 || strlen($request->password) > 40) {
            return response()->json([
                'success' => false, 
                'error' => 'Username must be between 3 and 40 characters'
            ]);
        }
        if(strlen($request->password) < 5) {
            return response()->json([
                'success' => false,
                'error' => 'Password must be at least 5 characters or more'
            ]);
        }

        
    }
        
    public function index() {
        return view('register');
    }
}