<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
require_once __DIR__.'/../vendor/autoload.php';

use App\Helpers\Route;

// function handleRequest($method, $request) {
//     Route::handle($method, $request);
// }

Route::handle($_SERVER['REQUEST_METHOD'], $_REQUEST);

// handleRequest($_SERVER['REQUEST_METHOD'], $_REQUEST);