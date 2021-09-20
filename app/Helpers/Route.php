<?php
namespace App\Helpers;

class Route {
    private static $current;
    static $routes = [];

    /**
     * Add GET request route
     * @param string $route Url of route you want to add
     * @param array|object $action Function or array with class + function to call
     * @return self
     */
    public static function get(string $route, array|object $action) {
        self::$routes['GET'][$route] = ['action' => $action, 'name' => ''];
        self::$current = ['method' => 'GET', 'route' => $route, 'action' => $action, 'name' => ''];
        return new self;
    }

    /**
     * Add POST request route
     * @param string $route Url of route you want to add
     * @param array|object $action Function or array with class + function to call
     * @return self
     */
    public static function post(string $route, array|object $action) {
        self::$routes['POST'][$route] = $action;
        self::$current = ['method' => 'POST', 'route' => $route, 'action' => $action, 'name' => ''];
        return new self;
    }

    /**
     * Add name to route for easier searching
     * @param string $name
     */
    public static function name(string $name) {
        self::$current['name'] = $name;
        self::$routes[self::$current['method']][self::$current['route']] = ['action' => self::$current['action'], 'name' => $name];
    }

    /**
     * Handle the route and call function linked
     * @param string $method
     * @param string $request
     */
    public static function handle(string $method, array $request) {
        self::registerRoutes();
        $route = $request['route'] ?? '/index';

        if(self::$routes[$method][$route] ?? false) {
            $findroute = self::$routes[$method][$route];

            if(is_callable($findroute['action'])) {
                echo $findroute['action']($request);
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