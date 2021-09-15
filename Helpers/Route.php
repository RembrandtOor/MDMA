<?php

class Route {
    static private $routes = [];

    public static function get($route, $action) {
        self::$routes['GET'][$route] = $action;
    }

    public static function post($route, $action) {
        self::$routes['POST'][$route] = $action;
    }

    public static function handle($method, $request) {
        $route = $request['route'] ?? 'index';

        $findroute = self::$routes[$method][$route];
        if($findroute != null) {
            if(is_callable($findroute)) {
                echo $findroute();
                return;
            }
            if(is_array($findroute)) {
                $controller_src = $findroute[0];
                require_once __DIR__.'/../Controllers/'.$findroute[0].'.php';
                $controller_name = explode('/', $findroute[0]);
                $controller_name = end($controller_name);
                $function_name = $findroute[1];
                $controller = new $controller_name;
                echo $controller->$function_name();
                return;
            }
            echo 'CANNOT FIND CONTROLLER?';
        }
        echo '404 NOT FOUND';
    }
}

function route() {
    return '';
}