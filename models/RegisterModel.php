<?php


namespace App\Models;


use App\Core\Model;

class RegisterModel extends Model
{
    public string $username;
    public string $email;
    public string $password;
    public string $passwordConfirm;
}