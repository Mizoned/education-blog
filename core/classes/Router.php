<?php

namespace Core\Classes;

class Router {
    protected array $routes = [];
    protected string $uri;
    protected string $method;

    public function __construct() {
        $this->uri = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
        $this->method = $this->getMethod();
    }

    public function getMethod(): string {
        $method = isset($_POST["_method"]) && !empty($_POST["_method"]) ? $_POST["_method"] : $_SERVER["REQUEST_METHOD"];
        return strtoupper($method);
    }

    public function init(): void {
        $this->route();
    }

    private function route(): void {
        $matches = false;

        foreach ($this->routes as $route) {
            if (($route["uri"] === $this->uri) && $route["method"] === strtoupper($this->method)) {

//                if ($route['middleware'] === 'guest') {
//                    if ($_SESSION["user"]) {
//                        header("Location: ");
//                    }
//                }

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

    public function only($middleware) {
        $lastKey = array_key_last($this->routes);
        $this->routes[$lastKey]['middleware'] = $middleware;
        return $this;
    }

    public function add($uri, $controller, $method) {
        $this->routes[] = [
            'uri' => $uri,
            'controller' => $controller,
            'method' => $method,
            'middleware' => null
        ];

        return $this;
    }

    public function get($uri, $controller) {
        return $this->add($uri, $controller, 'GET');
    }

    public function post($uri, $controller) {
        return $this->add($uri, $controller, 'POST');
    }

    public function delete($uri, $controller) {
        return $this->add($uri, $controller, 'DELETE');
    }

    public static function redirect($url) {
        if ($url) {
            $redirect = $url;
        } else {
            $redirect = $_SERVER['HTTP_REFERER'] ?? BASE_PATH;
        }
        header("Location: {$redirect}");
        die;
    }
}