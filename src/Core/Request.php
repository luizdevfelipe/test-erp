<?php

namespace App\Core;

class Request
{
    public function get(?string $key = null, mixed $default = null): mixed
    {
        if ($key === null) {
            return $_GET;
        }
        return $_GET[$key] ?? $default;
    }

    public function post(?string $key = null, mixed $default = null): mixed
    {
        if ($key === null) {
            return $_POST;
        }
        return $_POST[$key] ?? $default;
    }

    public function input(?string $key = null, mixed $default = null): mixed
    {
        $data = array_merge($_GET, $_POST);
        if ($key === null) {
            return $data;
        }
        return $data[$key] ?? $default;
    }  
}
