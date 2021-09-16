<?php
use App\Helpers\View;
use App\Helpers\Route;

function view($view_name, $parameters = []) { 
    echo View::render($view_name, $parameters);
}

function route($route_name) {
    foreach(Route::$routes[$_SERVER['REQUEST_METHOD']] as $route => $values){
        if($values['name'] == $route_name){
            return (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]/?route=".$route;
        }
    }
    return (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]/?route=".$route_name;
}
