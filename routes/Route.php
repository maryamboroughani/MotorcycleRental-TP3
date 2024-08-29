<?php
namespace App\Routes;

class Route {
    private static $routes = [];

    // Register a GET route
    public static function get($url, $controller) {
        self::$routes[] = ['url' => $url, 'controller' => $controller, 'method' => 'GET'];
    }

    // Register a POST route
    public static function post($url, $controller) {
        self::$routes[] = ['url' => $url, 'controller' => $controller, 'method' => 'POST'];
    }

    // Dispatch the request to the appropriate controller and method
    public static function dispatch() {
        $url = $_SERVER['REQUEST_URI'];
        $urlSegments = explode('?', $url);
        $urlPath = rtrim($urlSegments[0], '/'); 
        $method = $_SERVER['REQUEST_METHOD'];

        foreach (self::$routes as $route) {
            $routeUrl = ($route['url'] === '/') ? BASE : rtrim(BASE . $route['url'], '/');
            
            // Debugging output
            // echo 'BASE constant: ' . BASE . '<br>';
            // echo 'Route URL: ' . $route['url'] . '<br>';
            // echo 'Full Route Path: ' . $routeUrl . '<br>';
            // echo 'Requested URL Path: ' . $urlPath . '<br>';
            // echo 'Request Method: ' . $method . '<br>';
            // echo 'Route Method: ' . $route['method'] . '<br>';
            // echo '<hr>'; 

            // Compare the normalized paths
            if ($routeUrl == $urlPath && $route['method'] == $method) {
                $controllerSegments = explode('@', $route['controller']);
                $controllerName = "App\\Controllers\\" . $controllerSegments[0];
                $methodName = $controllerSegments[1];

                $controllerInstance = new $controllerName();
                if ($method == "GET") {
                    if (isset($urlSegments[1])) {
                        parse_str($urlSegments[1], $queryParams);
                        $controllerInstance->$methodName($queryParams);
                    } else {
                        $controllerInstance->$methodName();
                    }
                } elseif ($method === "POST") {
                    if (isset($urlSegments[1])) {
                        parse_str($urlSegments[1], $queryParams);
                        $controllerInstance->$methodName($_POST, $queryParams);
                    } else {
                        $controllerInstance->$methodName($_POST);
                    }
                }
                return;
            }
        }          
        http_response_code(404);
        echo "404 - Page not found";
    }
}
