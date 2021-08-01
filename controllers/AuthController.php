<?php


namespace App\Controllers;


use App\Core\Controller;
use App\Core\Request;

class AuthController extends Controller
{
    public function index()
    {
        $this->setLayout('auth');
        return $this->render('register');
    }

    public function register(Request $request)
    {
        $body = $request->getBody();
        print_r($body);
    }
}