<?php
namespace App\Helpers;

use App\Helpers\Request;

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
        self::$routes['POST'][$route] = ['action' => $action, 'name' => ''];
        self::$current = ['method' => 'POST', 'route' => $route, 'action' => $action, 'name' => ''];
        return new self;
    }

    /**
     * Add route that returns a view by default
     * @param string $route
     * @param string $view_name
     * @return self
     */
    public static function view(string $route, string $view_name) {
        self::$routes['GET'][$route] = [
            'view' => $view_name, 
            'name' => ''
        ];
        
        self::$current = [
            'method' => 'GET', 
            'route' => $route, 
            'view' => $view_name, 
            'name' => ''
        ];
        return new self;
    }

    /**
     * Add name to route for easier searching
     * @param string $name
     */
    public static function name(string $name) {
        self::$current['name'] = $name;

        $data = [
            'name' => $name
        ];
        if(isset(self::$current['action'])) $data['action'] = self::$current['action'];
        if(isset(self::$current['view'])) $data['view'] = self::$current['view'];

        self::$routes[self::$current['method']][self::$current['route']] = $data;
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

            if(isset($findroute['view'])) {
                echo View::render($findroute['view']);
                return true;
            }

            if(is_callable($findroute['action'])) {
                echo $findroute['action'](new Request($request));
                return true;
            }
            
            if(is_array($findroute)) {
                // require_once __DIR__.'/../'.$findroute['action'][0].'.php';
                // $controller_name = explode('/', $findroute['action'][0]);
                // $controller_name = end($controller_name);

                $function_name = $findroute['action'][1];

                $controller = new $findroute['action'][0];
                echo $controller->$function_name(new Request($request));
                return true;
            }
            echo 'CANNOT FIND CONTROLLER?';
        }
        echo '404 NOT FOUND';
    }

    /**
     * Register routes from routes file
     */
    private static function registerRoutes() {
        require_once __DIR__.'/../../routes.php';
    }
}