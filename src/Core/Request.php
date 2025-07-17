<?php

namespace App\Core;

class Request
{
    private array $get;
    private array $post;
    private array $server;
    private string $method;
    private string $uri;
    
    public function __construct()
    {
        $this->get = $_GET;
        $this->post = $_POST;
        $this->server = $_SERVER;
        $this->method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
        $this->uri = $_SERVER['REQUEST_URI'] ?? '/';
    }
    
    public function get(string $key = null, mixed $default = null): mixed
    {
        if ($key === null) {
            return $this->get;
        }
        return $this->get[$key] ?? $default;
    }
    
    public function post(string $key = null, mixed $default = null): mixed
    {
        if ($key === null) {
            return $this->post;
        }
        return $this->post[$key] ?? $default;
    }
    
    public function input(string $key = null, mixed $default = null): mixed
    {
        $data = array_merge($this->get, $this->post);
        if ($key === null) {
            return $data;
        }
        return $data[$key] ?? $default;
    }
    
    public function method(): string
    {
        return $this->method;
    }
    
    public function uri(): string
    {
        return $this->uri;
    }
    
    public function isPost(): bool
    {
        return $this->method === 'POST';
    }
    
    public function isGet(): bool
    {
        return $this->method === 'GET';
    }
    
    public function has(string $key): bool
    {
        return isset($this->get[$key]) || isset($this->post[$key]);
    }
    
    public function all(): array
    {
        return array_merge($this->get, $this->post);
    }
    
    public function only(array $keys): array
    {
        $data = $this->all();
        return array_intersect_key($data, array_flip($keys));
    }
    
    public function except(array $keys): array
    {
        $data = $this->all();
        return array_diff_key($data, array_flip($keys));
    }
}
