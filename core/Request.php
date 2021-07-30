<?php


namespace App\Core;


class Request
{
    /**
     * @return mixed|string
     */
    public function getPath()
    {
        $url = $_SERVER['REQUEST_URI'] ?? '/';
        $position = strpos(haystack: $url, needle: '?');
        if ($position === false) {
            return $url;
        }
        return substr($url, 0, $position);
    }

    public function getMethod(): string
    {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }

}