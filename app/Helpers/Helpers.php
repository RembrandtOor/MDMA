<?php
use App\Helpers\View;
use App\Helpers\Route;

/**
 * Returns view file and adds parameters as variables
 * @param string $view_name
 * @param array $parameters 
 */
function view(string $view_name, array $parameters = []) { 
    echo View::render($view_name, $parameters);
}

/**
 * Gets route full url by name / url
 * @param string $route_name 
 * @return string
 */
function route(string $route_name) {
    foreach(Route::$routes[$_SERVER['REQUEST_METHOD']] as $route => $values){
        if($values['name'] == $route_name){
            return (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]".dirname($_SERVER['PHP_SELF'])."/?route=".$route;
        }
    }
    return (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]".dirname($_SERVER['PHP_SELF'])."/?route=".$route_name;
}

/**
 * Redirect to given url
 * @param string $url
 */
function redirect(string $url) {
    header('Location: '.$url);
    exit();
}