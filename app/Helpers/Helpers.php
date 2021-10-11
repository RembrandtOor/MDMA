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

function getUrl() {
    $url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http");
    $url .= "://$_SERVER[HTTP_HOST]";
    $dirname = dirname($_SERVER['PHP_SELF']);
    $url .= $dirname == '/' ? $dirname : $dirname.'/';
    return $url;
}

/**
 * Gets route full url by name / url
 * @param string $route_name 
 * @return string
 */
function route(string $route_name, array $parameters = []) {
    $route = Route::getRoute($route_name);

    $url = getUrl();

    if(isset($_REQUEST['route'])) {
        $url .= '/?route=';
    }

    if($route)  {
        $url .= substr($route_name, 1);
    } else {
        $url .= $route_name;
    }

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

function dd($stuff) {
    print_r($stuff);
    echo '<br><br>';
}

function asset($asset_name) {
    $url = getUrl();
    $url .= $asset_name;
    return $url;
}