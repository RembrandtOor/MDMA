<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__.'/../routes.php';



class Index {
    public static function handleRequest($method, $request) {
        Route::handle($method, $request);
    }
}

Index::handleRequest($_SERVER['REQUEST_METHOD'], $_REQUEST);