<?php


namespace App\Controllers;


use App\Core\Application;
use App\Core\Controller;

class SiteController extends Controller
{
    public  function home()
    {
        $params = [
            "name"=>"Web Dev Env",
            "type"=>"Education"
        ];
        return $this->render( 'home',$params);
    }
}