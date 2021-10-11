<?php
namespace App\Helpers;

use App\Helpers\Request;

class Route {
    private static $current;
    public static $routes = [
        'POST' => [],
        'GET' => []
    ];
    private static $currentRoute;
    private static $currentRouteRegex;

    /**
     * Add GET request route
     * @param string $route Url of route you want to add
     * @param array|object $action Function or array with class + function to call
     * @return self
     */
    public static function get(string $route, $action) {
        self::$routes['GET'][$route] = ['route' => $route, 'action' => $action, 'name' => ''];
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
        self::$routes['POST'][$route] = ['route' => $route, 'action' => $action, 'name' => ''];
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
        if(isset(self::$current['route'])) $data['route'] = self::$current['route'];

        self::$routes[self::$current['method']][self::$current['route']] = $data;
    }

    public static function getRoute(string $route_name) {
        foreach(self::$routes[$_SERVER['REQUEST_METHOD']] as $key => $values){
            if($values['name'] == $route_name || $values['route'] == $route_name){
                $route = $key;
            }
        }
        if($route) {
            return $route;
        }
        return null;
    }

    public static function getCurrentRoute() {
        if(!isset(self::$currentRoute)){
            $route = $request['route'] ?? strtok($_SERVER['REQUEST_URI'], '?'); 
            $route = str_replace(dirname($_SERVER['PHP_SELF']), '/', $route);
            $route = str_replace('//', '/', $route);
            if(strlen($route) == 0) $route = '/';
            self::$currentRoute = $route;
            return $route;
        } 
        return self::$currentRoute;
    }

    public static function getCurrentRouteEscaped() {
        $route_regex = self::getCurrentRouteRegex();
        $find_routes = preg_grep($route_regex, array_keys(self::$routes[$_SERVER['REQUEST_METHOD']]));
        return $find_routes[array_key_first($find_routes)];
    }

    public static function getCurrentRouteRegex() {
        if(!isset(self::$currentRouteRegex)){
            $route = self::getCurrentRoute();
            $regex = preg_replace('/\/[1-9]+/', '/{.*}', $route);
            $regex = '/'.preg_replace('/\//', '\/', $regex).'/';
            self::$currentRouteRegex = $regex;
            return $regex;
        }
        return self::$currentRouteRegex;
    }

    public static function getParameters($route_name = null) {
        if($route_name) {
        
        } else {
            $route_esc = self::getCurrentRouteEscaped();
            dd($route_esc);
        }
        $route = self::getCurrentRoute();
        $route_regex = self::getCurrentRouteRegex();
        $parameters = preg_match_all('/{(.*)}/', $route_esc, $matches, PREG_PATTERN_ORDER);
        $regex = str_replace('{', '(', $route_regex);
        $regex = str_replace('}', ')', $regex);
        $values = preg_match_all($regex, $route, $matches2, PREG_PATTERN_ORDER);

        // dd($matches);
        // dd($matches2);

        $params = [];
        foreach($matches[1] as $key => $param) {
            $params[$param] = $matches2[1][$key];
        }
        // dd($params);
        return $params;
    }

    public static function getCurrentRouteData() {
        $route_regex = self::getCurrentRouteRegex();
        $find_routes = preg_grep($route_regex, array_keys(self::$routes[$_SERVER['REQUEST_METHOD']]));
        if(!empty($find_routes)) {
            $route_data = self::$routes[$_SERVER['REQUEST_METHOD']][$find_routes[array_key_first($find_routes)]];
            return $route_data;
        }
        return [];
    }

    /**
     * Handle the route and call function linked
     * @param string $method method of request, GET or POST
     * @param string $request
     */
    public static function handle(string $method, array $request) {
        self::registerRoutes();
        
        $route_data = self::getCurrentRouteData();
        // dd($route_data);

        if(empty($route_data)) {
            return view('error_pages.404');
        }

        if(isset($route_data['view'])) {
            return view($route_data['view']);
        }

        // $container = new \DI\Container();
        $builder = new \DI\ContainerBuilder();
        $builder->enableCompilation(__DIR__ . '/tpm');
        $builder->writeProxiesToFile(true, __DIR__ . '/tmp/proxies');

        $container = $builder->build();

        $parameters = self::getParameters();

        if(is_callable($route_data['action'])) {
            $container->call($route_data['action'], $parameters);
            return;
        }
        
        if(is_array($route_data['action'])) {
            $function_name = $route_data['action'][1];
            $controller_name = $route_data['action'][0];

            $container->call([$controller_name, $function_name], $parameters);
            return;
        }
        
        echo 'CANNOT FIND CONTROLLER?';
    }

    /**
     * Register routes from routes file
     */
    private static function registerRoutes() {
        require_once __DIR__.'/../../routes.php';
    }
}