<?php
require_once __DIR__.'/../Helpers/View.php';

class IndexController {    
    public function index() {
        return view('index');
    }
}