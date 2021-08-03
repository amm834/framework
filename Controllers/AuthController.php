<?php


namespace App\Controllers;


use App\Core\Controller;
use App\Core\Request;
use App\Models\RegisterModel;

class AuthController extends Controller
{
    public function index()
    {
        $this->setLayout('auth');
        return $this->render('register');
    }

    public function register(Request $request)
    {
        if (!$request->isPost()) {
            return "Get Method Not Allowed";
        }
        $registerModel = new RegisterModel();
        $registerModel->loadData($request->getBody());

        if ($registerModel->validate()) {
            return  "success";
        }
        echo "<pre>";
        print_r($registerModel->errors);
    }
}