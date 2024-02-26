<?php

namespace Core\Classes;

class Router {
    protected array $routes = [];
    protected string $uri;
    protected string $method;

    public function __construct() {
        $this->uri = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
        $this->method = $_POST['_method'] ?? $_SERVER["REQUEST_METHOD"];
    }

    // Регистрация маршрута
    public function register($url, $controllerName, $actionName = 'index') {
        $this->routes[$url] = ['controller' => $controllerName, 'action' => $actionName];
    }

    public function init() {
        $this->route();
    }

    public function route() {
        $matches = false;

        foreach ($this->routes as $route) {
            if (($route["uri"] === $this->uri) && $route["method"] === strtoupper($this->method)) {
                $matches = true;

                $controllerStr = $route['controller'][0];
                $action = $route['controller'][1];

                $implodeControllerArray = explode("\\", $controllerStr);

                $fileController = CONTROLLERS . DIRECTORY_SEPARATOR . $implodeControllerArray[count($implodeControllerArray) - 1] . ".php";

                if (file_exists($fileController)) {
                    if (class_exists($controllerStr)) {
                        $controller = new $controllerStr();

                        if (method_exists($controller, $action)) {
                            $controller->$action();
                        } else {
                            $matches = false;
                            echo "Method not found!";
                        }
                    } else {
                        $matches = false;
                        echo "Controller class not found in file!";
                    }
                }

                break;
            }
        }

        if (!$matches) {
            http_response_code(404);
            require_once TEMPLATES . "/errors/404.php";
        }
    }

    public function add($uri, $controller, $method) {
        $this->routes[] = [
            'uri' => $uri,
            'controller' => $controller,
            'method' => $method
        ];
    }

    public function get($uri, $controller) {
        $this->add($uri, $controller, 'GET');
    }

    public function post($uri, $controller) {
        $this->add($uri, $controller, 'POST');
    }

    public function delete($uri, $controller) {
        $this->add($uri, $controller, 'DELETE');
    }
}