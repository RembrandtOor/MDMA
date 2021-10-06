<?php
namespace App\Controllers\Auth;

use App\Helpers\Request;
use App\Helpers\Auth;
use App\Models\User;

class LoginController {
    public function login(Request $request) {
        $user = User::firstWhere('username', $request->username);
        if($user == null) {
            return response()->json([
                'success' => false, 
                'error' => 'No user with this username found'
            ]);
        }

        if(!$user->passwordMatch($request->password)) {
            return response()->json([
                'success' => false, 
                'error' => 'Passwords do not match'
            ]);
        }

        Auth::login($user);

        return response()->json([
            'success' => true,
            'message' => 'Logged in successfully'
        ]);
    }
        
    public function index() {
        if(Auth::check()) {
            return redirect('playlists');
        }
        return view('login');
    }
}