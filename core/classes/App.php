<?php

namespace Core\Classes;

class App {
    protected static array $instances = [];

    public static function use(string $name, $class): void {
        static::$instances[$name] = $class;
    }

    public static function get($service) {
        return static::$instances[$service];
    }

    public static function init(): void {
        foreach (static::$instances as $instance) {
            if (method_exists($instance, "init")) {
                $instance->init();
            }
        }
    }
}