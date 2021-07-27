<?php

namespace App\Core;


use Closure;

class Router
{
    protected array $routes = [];
    public Request $request;

    /**
     * Router constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function get(string $path,string|Closure $callback)
    {
        $this->routes['get'][$path] = $callback;
    }

    public function resolve() : void
    {
        $path = $this->request->getPath();
        $method = $this->request->getMethod();
        $callback = $this->routes[$method][$path] ?? false;
        if ($callback === false){
            echo "404 | Page Not Found";
            exit();
        }
       echo  call_user_func($callback);
    }
}