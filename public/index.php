<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__.'/../routes.php';

function handleRequest($method, $request) {
    Route::handle($method, $request);
}

handleRequest($_SERVER['REQUEST_METHOD'], $_REQUEST);