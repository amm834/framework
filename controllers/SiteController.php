<?php


namespace App\Controllers;


use App\Core\Application;

class SiteController
{
    public  function home()
    {
        $params = [
            "name"=>"Web Dev Env"
        ];
        return Application::$app->router->renderView('home',$params);
    }
}