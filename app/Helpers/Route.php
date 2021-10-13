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
    private static $currentData;

    /**
     * Add GET request route
     * @param string $route Url of route you want to add
     * @param array|object $action Function or array with class + function to call
     * @return self
     */
    public static function get(string $route, $action) {
        $data = [
            'method' => 'GET',
            'route' => $route,
            'action' => $action,
            'name' => '',
            'middleware' => self::$currentData['middleware'] ?? []
        ];
        self::$routes['GET'][$route] = $data;
        self::$current = $data;
        return new self;
    }

    /**
     * Add POST request route
     * @param string $route Url of route you want to add
     * @param array|object $action Function or array with class + function to call
     * @return self
     */
    public static function post(string $route, $action) {
        $data = [
            'method' => 'POST',
            'route' => $route,
            'action' => $action,
            'name' => $action,
            'middleware' => self::$currentData['middleware'] ?? []
        ];
        self::$routes['POST'][$route] = $data;
        self::$current = $data;
        return new self;
    }

    /**
     * Add route that returns a view by default
     * @param string $route
     * @param string $view_name
     * @return self
     */
    public static function view(string $route, string $view_name) {
        $data = [
            'method' => 'GET',
            'route' => $route,
            'name' => '',
            'view' => $view_name,
            'middleware' => self::$currentData['middleware'] ?? []
        ];
        self::$routes['GET'][$route] = $data;
        self::$current = $data;
        return new self;
    }

    /**
     * Add name to route for easier searching
     * @param string $name
     */
    public static function name(string $name) {
        self::$current['name'] = $name;
        $data = self::$current;
        self::$routes[$data['method']][$data['route']] = $data;
    }

    public static function getRoute(string $route_name): ?string {
        foreach(self::$routes as $method => $routes) {
            if(isset($routes[$route_name])) {
                return $routes[$route_name];
            }
            foreach($routes as $route => $route_data) {
                if($route_data['name'] == $route_name) {
                    return $route;
                }
            }
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

    public static function getRouteEscaped($route = null) {
        $route_regex = self::getRouteRegex($route);
        $find_routes = preg_grep($route_regex, array_keys(self::$routes[$_SERVER['REQUEST_METHOD']]));
        return $find_routes[array_key_first($find_routes)];
    }

    public static function getRouteRegex($route = null) {
        $route = $route ?? self::getCurrentRoute();
        $regex = preg_replace('/\/[1-9]+/', '/{.*}', $route);
        $regex = '/'.preg_replace('/\//', '\/', $regex).'/';
        return $regex;
    }

    public static function getParameters($route = null): array {
        $route = $route ?? self::getCurrentRoute();
        $route_esc = self::getRouteEscaped($route);
        $route_regex = self::getRouteRegex($route);
        $parameters = preg_match_all('/{(.*)}/', $route_esc, $matches, PREG_PATTERN_ORDER);
        if($parameters == 0) {
            return [];
        }
        $regex = str_replace('{', '(', $route_regex);
        $regex = str_replace('}', ')', $regex);
        $values = preg_match_all($regex, $route, $matches2, PREG_PATTERN_ORDER);

        // dd($matches);
        // dd($regex);
        // dd($matches2);

        foreach($matches[1] as $key => $param) {
            $params[$param] = $matches2[1][$key];
        }
        return $params ?? [];
    }

    public static function getRouteParameters($route = null) {
        $route = $route ?? self::getCurrentRoute();
        $parameters = preg_match_all('/{(.*)}/', $route, $matches, PREG_PATTERN_ORDER);
        return $matches[1] ?? [];
    }

    public static function setParameters(string $route = null, array $parameters = []) {
        $route = $route ?? self::getCurrentRoute();
        foreach($parameters as $key => $value) {
            $keys[] = '/{'.$key.'}/';
            $values[] = $value;
        }
        return preg_replace($keys, $values, $route);
    }

    public static function getCurrentRouteData() {
        $route_regex = self::getRouteRegex();
        $find_routes = preg_grep($route_regex, array_keys(self::$routes[$_SERVER['REQUEST_METHOD']]));
        if(!empty($find_routes)) {
            $route_data = self::$routes[$_SERVER['REQUEST_METHOD']][$find_routes[array_key_first($find_routes)]];
            return $route_data;
        }
        return [];
    }

    public static function middleware(mixed $middleware, callable $function) {
        if(!is_callable($function)) return false;

        if(is_array($middleware)) {
            foreach($middleware as $protection){
                self::$currentData['middleware'][] = $protection;
            }
        } else {
            self::$currentData['middleware'][] = $middleware;
        }

        return $function();
    }

    public static function group(array $data, callable $function) {
        if(!is_callable($function)) return false;

        foreach($data as $key => $value){
            if(in_array($key, ['middleware'])){
                self::$currentData[$key][] = $value;
            }
        }

        return $function();
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

        $routeMiddleware = getMiddleware();
        foreach($route_data['middleware'] as $middleware) {
            if(isset($routeMiddleware[$middleware])){
                (new $routeMiddleware[$middleware])->handle();
            }
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
            return $container->call($route_data['action'], $parameters);
        }
        
        if(is_array($route_data['action'])) {
            $function_name = $route_data['action'][1];
            $controller_name = $route_data['action'][0];

            return $container->call([$controller_name, $function_name], $parameters);
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