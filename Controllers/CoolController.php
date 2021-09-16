<?php
require_once __DIR__.'/../Helpers/Route.php';
require_once __DIR__.'/../Helpers/View.php';

class CoolController {    
    public function index() {
        return view('dani', ['kutjong' => 'dani']);
    }
}