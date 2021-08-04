<?php


namespace App\Controllers;


use App\Core\Controller;
use App\Core\Request;
use App\Models\RegisterModel;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $registerModel = new RegisterModel();

        if ($request->isPost()) {

            $registerModel->loadData($request->getBody());

            if ($registerModel->validate()) {
                return "success";
            }

        }

        $this->setLayout('auth');
        return $this->render('register',
            [
                'model' => $registerModel
            ]
        );
    }
}