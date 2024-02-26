<?php

namespace Core;

class Router2 {
    public array $routes = [];
    protected $uri;
    protected $method;

    public function __construct() {
        $uri = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
        $url = trim($uri, '/');
        $this->uri = $url;
        $this->method = $_POST['_method'] ?? $_SERVER["REQUEST_METHOD"];
    }

    public function match() {
        $matches = false;

        foreach ($this->routes as $route) {
            if (($route["uri"] === $this->uri) && $route["method"] === strtoupper($this->method)) {
                $matches = true;
                break;
            }
        }

        if (!$matches) {

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