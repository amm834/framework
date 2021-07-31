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

    public function getBody()
    {
        $body = [];
        if ($this->getMethod() === 'get'){
            foreach ($_POST as $key => $value) {
                $body[$key] = filter_input(INPUT_GET,$key,FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }
        if ($this->getMethod() === 'post'){
            foreach ($_POST as $key => $value) {
                $body[$key] = filter_input(INPUT_POST,$key,FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }
        return $body;
    }
}