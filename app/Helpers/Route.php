<?php
namespace App\Helpers;

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

    public static function handle($method, $request) {
        self::registerRoutes();
        $route = $request['route'] ?? '/index';

        if(self::$routes[$method][$route] ?? false) {
            $findroute = self::$routes[$method][$route];
            if(is_callable($findroute)) {
                echo $findroute();
                return true;
            }
            if(is_array($findroute)) {
                // require_once __DIR__.'/../'.$findroute['action'][0].'.php';
                // $controller_name = explode('/', $findroute['action'][0]);
                // $controller_name = end($controller_name);

                $function_name = $findroute['action'][1];

                $controller = new $findroute['action'][0];
                echo $controller->$function_name();
                return true;
            }
            echo 'CANNOT FIND CONTROLLER?';
        }
        echo '404 NOT FOUND';
    }

    private static function registerRoutes() {
        require_once __DIR__.'/../../routes.php';
    }
}