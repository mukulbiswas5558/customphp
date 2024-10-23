<?php
class Router {
    private $basePath;
    private $routes = [];

    public function __construct($basePath = '') {
        $this->basePath = rtrim($basePath, '/');
    }

    public function get($route, $action) {
        $this->routes['GET'][$this->basePath . $route] = $action;
    }

    public function post($route, $action) {
        $this->routes['POST'][$this->basePath . $route] = $action;
    }

    public function put($route, $action) {
        $this->routes['PUT'][$this->basePath . $route] = $action;
    }

    public function delete($route, $action) {
        $this->routes['DELETE'][$this->basePath . $route] = $action;
    }

    public function dispatch() {
        // Remove query strings and normalize URI
        $requestUri = strtok($_SERVER['REQUEST_URI'], '?');
        $method = $_SERVER['REQUEST_METHOD'];

        // Method override for PUT/DELETE via POST
        if ($method === 'POST' && isset($_POST['_method'])) {
            $method = strtoupper($_POST['_method']);
        }

        if (isset($this->routes[$method][$requestUri])) {
            [$controller, $method] = $this->routes[$method][$requestUri];
            call_user_func([new $controller, $method]);
        } else {
            http_response_code(404);
            echo "404 - Page Not Found";
        }
    }
}
?>
