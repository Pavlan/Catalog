<?php


namespace app\core;


use RuntimeException;

class Router
{
    private static $rules;
    private static $route;
    private static $params;

    public static function routed(): void
    {
        self::readConfig();
        $url = self::parseUrl();
        self::prepareRoute($url);
        self::runController();
    }

    private static function readConfig(): void
    {
        self::$rules = require dirname(__DIR__) . '/config/routes.php';
    }

    private static function parseUrl(): string
    {
        return trim($_SERVER['QUERY_STRING'], '/');
    }

    private static function prepareRoute(string $url): void
    {
        $route = self::matchRoute($url);
        if ($route) {
            self::$params = $route['params'];
            $preparedRoute['controller'] = self::prepareControllerName($route['controller']);
            $preparedRoute['action'] = self::prepareActionName($route['action']);
            self::$route = $preparedRoute;
        } else {
            throw new RuntimeException('Page not found', 404);
        }
    }

    private static function runController(): void
    {
        if (file_exists(dirname(__DIR__) . '/../' . self::$route['controller'] . '.php')) {
            Model::$db = new Db();
            $view = new View();
            $controllerObject = new self::$route['controller']($view, self::$params);
            if (method_exists($controllerObject, self::$route['action'])) {
                $controllerObject->{self::$route['action']}();
            } else {
                throw new RuntimeException('Method not found', 404);
            }
        } else {
            throw new RuntimeException('Controller not found', 404);
        }
    }

    private static function matchRoute(string $url): array
    {
        foreach (self::$rules as $pattern => $route) {
            if (preg_match("#{$pattern}#", $url, $matches)) {
                foreach ($matches as $key => $value) {
                    if (is_string($key)) {
                        $route[$key] = $value;
                    }
                }
                $route['action'] = $route['action'] ?? 'index';
                $route['params'] = $route['params'] ?? '';
                return $route;
            }
        }
        return[];
    }

    private static function prepareControllerName(string $controllerName): string
    {
        return 'app\controllers\\' . self::strToCamelCase($controllerName) . 'Controller';
    }

    private static function prepareActionName(string $actionName): string
    {
        return 'action' . self::strToCamelCase($actionName);
    }

    private static function strToCamelCase(string $string): string
    {
        return ucfirst(strtolower($string));
    }
}