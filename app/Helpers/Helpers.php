<?php
// namespace App\Helpers;

use App\Helpers\View;
use App\Helpers\Route;
use App\Helpers\Auth;

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
function route(string $route_name, array $parameters = []) {
    foreach(Route::$routes[$_SERVER['REQUEST_METHOD']] as $route => $values){
        if($values['name'] == $route_name){
            $route_name = $route;
        }
    }
    $url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http");
    $url .= "://$_SERVER[HTTP_HOST]";
    $url .= str_replace('//', '/', dirname($_SERVER['PHP_SELF']).'/');

    if(isset($_REQUEST['route'])) {
        $url .= '/?route=';
    }

    $url .= substr($route_name, 1);

    foreach($parameters as $key => $value){
        if($key == array_key_first($parameters)) {
            $url .= '?';
        } else {
            $url .= '&';
        }
        $url .= "$key=$value";
    }
    return $url;
}

/**
 * Redirect to given url
 * @param string $url
 */
function redirect(string $url) {
    header('Location: '.$url);
    exit();
}

class response {
    public function json(array $data) {
        header('Content-type: application/json');
        exit(json_encode($data));
    }
}

function response() {
    return new response();
}