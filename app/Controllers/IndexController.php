<?php
namespace App\Controllers;

class IndexController extends Controller {    
    public function index() {
        return view('index', ['hello' => 'dani']);
    }
}