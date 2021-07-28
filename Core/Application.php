<?php

namespace App\Core;

/**
 * @property Request request
 * @property Router router
 */

class Application
{
    public Router $router;
    public Request $request;
    public static string $ROOT_DIR;
    /**
     * Application constructor.
     */
     public function __construct(string $rootPath)
    {
        self::$ROOT_DIR = $rootPath;
        $this->request = $this->request = new Request();
        $this->router = new Router($this->request);
    }

    public function run()
    {
        echo $this?->router?->resolve();
    }

}