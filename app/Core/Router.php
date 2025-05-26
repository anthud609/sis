<?php
namespace App\Core;

class Router
{
    protected $routes = [];

    public function get($path, $controllerAction)
    {
        $this->routes['GET'][$this->normalize($path)] = $controllerAction;
    }

    public function dispatch($uri)
    {
        $uri = parse_url($uri, PHP_URL_PATH);
        $method = $_SERVER['REQUEST_METHOD'];

        $path = $this->normalize($uri);
        $action = $this->routes[$method][$path] ?? null;

        if (!$action) {
            http_response_code(404);
            echo "404 Not Found";
            return;
        }

        [$controller, $method] = explode('@', $action);
        [$module, $ctrl] = explode('\\', $controller);

        $controllerClass = "App\\Modules\\$module\\Controllers\\$ctrl";

        if (!class_exists($controllerClass)) {
http_response_code(500);
echo "500 Internal Server Error - Controller $controllerClass not found";
            return;
        }

        $instance = new $controllerClass();
        call_user_func([$instance, $method]);
    }

    private function normalize($path)
    {
        return '/' . trim($path, '/');
    }
}
