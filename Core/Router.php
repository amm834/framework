<?php

namespace App\Core;


use Closure;

class Router
{
    protected array $routes = [];
    protected Request $request;
    protected Response $response;


    /**
     * Router constructor.
     * @param Request $request
     * @param Response $response
     */
    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }

    public function get($path, $callback)
    {
        $this->routes['get'][$path] = $callback;
    }

    public function post(string $path, string|Closure|array $callback)
    {
        $this->routes['post'][$path] = $callback;
    }


    public function resolve()
    {
        $path = $this->request->getPath();
        $method = $this->request->method();
        $callback = $this->routes[$method][$path] ?? false;
        // exit if callback is not valid
        if (!$callback) {
            $this->response->setStausCode(code: 404);
            return $this->renderView('_404');
        }

        // return views file
        if (is_string($callback)) {
            return $this->renderView($callback);
        }

        if (is_array($callback)) {
            // invoke class itself
            Application::$app->controller = new $callback[0]();
            $callback[0] = Application::$app->controller;
        }
        // call the function
        return $callback($this->request);
    }

    /**
     * @param $view
     * @return array|false|string|string[]
     */
    public function renderView($view, $params = [])
    {
        $layoutContent = $this->renderLayoutContent();
        $viewContent = $this->renderOnlyView($view, $params);
        return str_replace("{{content}}", $viewContent, $layoutContent);

    }

    protected function renderLayoutContent(): bool|string
    {
        $layout = Application::$app->controller->layout;
        include_once Application::$ROOT_DIR . "/views/layouts/$layout.php";
        return ob_get_clean();
    }

    /**
     * @param $view
     * @return false|string
     */
    protected function renderOnlyView($view, $params = []): bool|string
    {
        foreach ($params as $key => $value) {
            $$key = $value;
        }
        ob_start();
        include_once Application::$ROOT_DIR . '/views/' . $view . '.php';
        return ob_get_clean();
    }
}