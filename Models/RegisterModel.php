<?php


namespace App\Models;


use App\Core\Model;

class RegisterModel extends Model
{
    public string $username;
    public string $email;
    public string $password;
    public string $passwordConfirm;


    function rules(): array
    {
        // rules implementation for the register model
        return [
            'username' => [self::RULE_REQUIRED],
            'email' => [self::RULE_REQUIRED,self::RULE_EMAIL],
            'password' => [
                self::RULE_REQUIRED,
                [self::RULE_MIN, 'min' => 6],
                [self::RULE_MAX, 'max' => 8]
            ],
            'passwordConfirm' => [
                self::RULE_REQUIRED,
                [self::RULE_MATCH, 'match' => 'password']
            ]
        ];
    }
}