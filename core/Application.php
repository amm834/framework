<?php

namespace App\Core;

/**
 * @property Request request
 * @property Router router
 */

class Application
{
    public static Application $app;
    public Router $router;
    public Request $request;
    public Response $response;
    public Controller $controller;

    public static string $ROOT_DIR;
    /**
     * Application constructor.
     */
     public function __construct (string $rootPath)
    {
        self::$app = $this;
        $this->controller = new Controller();
        self::$ROOT_DIR = $rootPath;
        $this->request = $this->request = new Request();
        $this->response = new Response();
        $this->router = new Router($this->request,$this->response);

    }

    public function run(): void
    {
        echo $this?->router?->resolve();
    }

}