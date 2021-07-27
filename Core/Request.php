<?php


namespace App\Core;


class Request
{
    public function getPath()
    {
        $url = $_SERVER['REQUEST_URI'] ?? '/';
        $position = strpos($url, '?');
        if ($position === false) {
            return $url;
        }
        return substr($url, 0, $position);
    }

    public function getMethod() : string
    {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }
}