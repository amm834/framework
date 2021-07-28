<?php

namespace App\Core;


use Closure;

class Router
{
    protected array $routes = [];
    protected Request $request;


    /**
     * Router constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function get(string $path, string|Closure $callback)
    {
        $this->routes['get'][$path] = $callback;
    }

    public function resolve()
    {
        $path = $this->request->getPath();
        $method = $this->request->getMethod();
        $callback = $this->routes[$method][$path] ?? false;
        // exit if callback is not valid
        if (!$callback) {
            return "404 | Page Not Found";
        }

        // return views file
        if (is_string($callback)) {
            return $this->renderView($callback);
        }

        return call_user_func($callback);
    }

    protected function renderView($view)
    {
        $layoutContent = $this->renderLayoutContent();
        $viewContent = $this->renderOnlyView($view);
        return str_replace("{{content}}",$viewContent,$layoutContent);

    }

    protected function renderLayoutContent()
    {
        ob_start();
        include_once Application::$ROOT_DIR . "/views/main.php";
        return ob_get_clean();
    }

    protected function renderOnlyView($view)
    {
        ob_start();
        include_once Application::$ROOT_DIR."/views/$view.php";
        return ob_get_clean();
    }
}