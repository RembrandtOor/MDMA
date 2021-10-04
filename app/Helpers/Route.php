<?php
namespace App\Helpers;

use App\Helpers\Request;

class Route {
    private static $current;
    static $routes = [
        'POST' => [],
        'GET' => []
    ];

    /**
     * Add GET request route
     * @param string $route Url of route you want to add
     * @param array|object $action Function or array with class + function to call
     * @return self
     */
    public static function get(string $route, $action) {
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
    public static function post(string $route, $action) {
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
     * @param string $method method of request, GET or POST
     * @param string $request
     */
    public static function handle(string $method, array $request) {
        self::registerRoutes();
        $route = $request['route'] ?? $_SERVER['REQUEST_URI']; 

        $route_rep = preg_replace('/\/[1-9]/', '/{.*}', $route);
        $route_rep = '/'.preg_replace('/\//', '\/', $route_rep).'/';

        $find_routes = preg_grep($route_rep, array_keys(self::$routes[$method]));
        if(count($find_routes) > 0) {
            $findroute = self::$routes[$method][$route];
            if($findroute == null) {
                $route_url = array_values($find_routes)[0];
                $findroute = self::$routes[$method][$route_url];
            }
            // $parameters = preg_match_all('/{(.*)}/', $route_url, $matches);
            // var_dump($matches);

            if(isset($findroute['view'])) {
                echo View::render($findroute['view']);
                return true;
            }

            if(is_callable($findroute['action'])) {
                $container = new \DI\Container();
                $container->call($findroute['action']);
                // echo $findroute['action'](new Request($request));
                return true;
            }
            
            if(is_array($findroute)) {
                // require_once __DIR__.'/../'.$findroute['action'][0].'.php';
                // $controller_name = explode('/', $findroute['action'][0]);
                // $controller_name = end($controller_name);

                $function_name = $findroute['action'][1];
                $controller_name = $findroute['action'][0];

                $container = new \DI\Container();
                $container->call([$controller_name, $function_name]);
                // echo $controller->$function_name(new Request($request));
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