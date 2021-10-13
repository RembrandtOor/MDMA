<?php
namespace App\Middleware;

use App\Helpers\Auth;
use App\Helpers\Request;

class Authenticated {
    public $hi = 'hello';

    public function handle() {
        if(Auth::check()){
            // return $next();
            return true;
        }
        
        return response(401)->view('error_pages/401');
    }
}