<?php


namespace App\Core;


class Response
{
    public function setStausCode(int $code)
    {
        http_response_code($code);
    }
}