<?php
require_once __DIR__.'/View.php';

class Route {
    private static $current;
    static $routes = [];
    // static $method, $route, $action, $name;

    // public function __destruct() {
    //     self::$routes[self::$method][self::$route] = ['action' => self::$action, 'name' => self::$name];
    // }

    public static function get($route, $action) {
        // self::$routes['GET'][$route] = $action;
        self::$routes['GET'][$route] = ['action' => $action, 'name' => ''];
        self::$current = ['method' => 'GET', 'route' => $route, 'action' => $action, 'name' => ''];
        // self::$method = 'GET';
        // self::$route = $route;
        // self::$action = $action;
        return new self;
    }

    public static function post($route, $action) {
        self::$routes['POST'][$route] = $action;
        // self::$method = 'GET';
        // self::$route = $route;
        // self::$action = $action;
        // return new self;
    }

    public static function name($name) {
        self::$current['name'] = $name;
        self::$routes[self::$current['method']][self::$current['route']] = ['action' => self::$current['action'], 'name' => $name];
        // var_dump(self::$routes);
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
                require_once __DIR__.'/../Controllers/'.$findroute['action'][0].'.php';
                $controller_name = explode('/', $findroute['action'][0]);
                $controller_name = end($controller_name);

                $function_name = $findroute['action'][1];

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
    foreach(Route::$routes[$_SERVER['REQUEST_METHOD']] as $route => $values){
        if($values['name'] == $route_name){
            return (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]/?route=".$route;
        }
    }
    return (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]/?route=".$route_name;
}
