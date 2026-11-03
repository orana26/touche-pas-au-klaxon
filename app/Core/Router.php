<?php
namespace App\Core;

/** Routeur HTTP minimaliste pour l'architecture MVC. */
final class Router
{
    /** @var array<int, array{method:string,pattern:string,handler:callable}> */
    private array $routes = [];

    public function get(string $pattern, callable $handler): void { $this->add('GET', $pattern, $handler); }
    public function post(string $pattern, callable $handler): void { $this->add('POST', $pattern, $handler); }

    private function add(string $method, string $pattern, callable $handler): void
    {
        $this->routes[] = compact('method','pattern','handler');
    }

    public function dispatch(string $method, string $uri): void
    {
        $path = parse_url($uri, PHP_URL_PATH) ?: '/';
        foreach ($this->routes as $route) {
            if ($route['method'] !== $method) continue;
            $regex = preg_replace('#\{([a-zA-Z_][a-zA-Z0-9_]*)\}#', '(?P<$1>[^/]+)', $route['pattern']);
            if (preg_match('#^' . $regex . '$#', $path, $matches)) {
                $params = array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY);
                call_user_func($route['handler'], ...array_values($params));
                return;
            }
        }
        http_response_code(404);
        echo 'Page introuvable.';
    }
}