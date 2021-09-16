<?php
require_once __DIR__.'/View.php';

class Route {
    static $routes = [];
    // static $method, $route, $action, $name;

    // public function __destruct() {
    //     self::$routes[self::$method][self::$route] = ['action' => self::$action, 'name' => self::$name];
    // }

    public static function get($route, $action) {
        self::$routes['GET'][$route] = $action;
        // self::$method = 'GET';
        // self::$route = $route;
        // self::$action = $action;
        // return new self;
    }

    public static function post($route, $action) {
        self::$routes['POST'][$route] = $action;
        // self::$method = 'GET';
        // self::$route = $route;
        // self::$action = $action;
        // return new self;
    }

    // public function name($name) {
    //     self::$name = $name;
    //     // var_dump(self::$method, self::$route, self::$action, self::$name);
    // }

    public static function handle($method, $request) {
        $route = $request['route'] ?? '/index';

        if(self::$routes[$method][$route] ?? false) {
            $findroute = self::$routes[$method][$route];
            if(is_callable($findroute)) {
                echo $findroute();
                return true;
            }
            if(is_array($findroute)) {
                require_once __DIR__.'/../Controllers/'.$findroute[0].'.php';
                $controller_name = explode('/', $findroute[0]);
                $controller_name = end($controller_name);

                $function_name = $findroute[1];

                $controller = new $controller_name;
                echo $controller->$function_name();
                return true;
            }
            echo 'CANNOT FIND CONTROLLER?';
        }
        echo '404 NOT FOUND';
    }
}

function route($route_name) {
    // return array_search($route_name, array_column(Route::$routes, 'name'));
    // return array_column(Route::$routes, 'name');
    return (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]/?route=".$route_name;
}

