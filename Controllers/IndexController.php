<?php
require_once __DIR__.'/../Helpers/Route.php';
require_once __DIR__.'/../Helpers/View.php';

class IndexController {    
    public function index() {
        return view('index', ['hello' => 'dani']);
    }
}