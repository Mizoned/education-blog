<?php

namespace Core\Classes;

class Router {
    protected array $routes = [];
    protected string $uri;
    protected string $method;

    public function __construct() {
        $this->uri = trim(parse_url($_POST["_method"] ?? $_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
        $this->method = $_POST['_method'] ?? $_SERVER["REQUEST_METHOD"];
    }

    // Регистрация маршрута
    public function register($url, $controllerName, $actionName = 'index') {
        $this->routes[$url] = ['controller' => $controllerName, 'action' => $actionName];
    }

    public function init() {
        $this->route();
    }

    // Обработка запроса
    public function route() {
        $this->uri = trim(parse_url($_POST["_method"] ?? $_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');

        if (isset($this->routes[$this->uri])) {
            $route = $this->routes[$this->uri];
            $controllerName = $route['controller'];
            $actionName = $route['action'];

            $controllerFile = CONTROLLERS . "/$controllerName.php";

            if (file_exists($controllerFile)) {
                require_once $controllerFile;
                // Добавляем пространство имен к имени класса
                $fullControllerName = 'app\\controllers\\' . $controllerName;
                if (class_exists($fullControllerName)) {
                    $controller = new $fullControllerName();
                    if (method_exists($controller, $actionName)) {
                        $controller->$actionName();
                    } else {
                        echo "Action not found!";
                    }
                } else {
                    echo "Controller class not found in file!";
                }
            } else {
                echo "Controller file not found!";
            }
        } else {
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