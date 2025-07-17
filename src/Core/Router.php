<?php

namespace App\Core;

class Router
{
    private $routes = [];

    public function get(string $route, callable|array $callback): void
    {
        $this->routeStore('GET', $route, $callback);
    }

    public function post(string $route, array $callback): void
    {
        $this->routeStore('POST', $route, $callback);
    }

    public function routeStore(string $method, string $route, array $callback): void
    {
        $this->routes[$method][$route] = $callback;
    }

    public function dispatch(string $route, string $method = 'GET')
    {
        if (isset($this->routes[$method][$route])) {
            $callback = $this->routes[$method][$route];
            if (is_callable($callback)) {
                return call_user_func($callback);
            } elseif (is_array($callback) && count($callback) === 2) {
                $controller = Application::getContainer()->get($callback[0]);
                $method = $callback[1];
                if (method_exists($controller, $method)) {
                    return call_user_func([$controller, $method]);
                }
            }
        }
    }
}
