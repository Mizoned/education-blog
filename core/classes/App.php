<?php

namespace Core\Classes;

class App {
    public array $instances = [];

    public function use(string $name, $class): void {
        $this->instances[$name] = $class;
    }

    public function init(): void {
        foreach ($this->instances as $instance) {
            if (method_exists($instance, "init")) {
                $instance->init();
            }
        }
    }
}