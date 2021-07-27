<?php

namespace App\Core;

use JetBrains\PhpStorm\Pure;

/**
 * @property Request request
 */
class Application
{
    public Router $router;


    /**
     * Application constructor.
     */
    #[Pure] public function __construct()
    {
        $request = $this->request = new Request();
        $this->router = new Router($request);
    }

    public function run()
    {
        $this?->router?->resolve();
    }

}