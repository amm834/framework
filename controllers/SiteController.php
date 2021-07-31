<?php


namespace App\Controllers;


use App\Core\Application;
use App\Core\Controller;
use App\Core\Request;

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

    public function handleContact(Request $request)
    {
        $body = $request->getBody();
        print_r($body);

    }
}