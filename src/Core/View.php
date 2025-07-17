<?php 

namespace App\Core;

class View 
{
    public static function render(string $viewPath, array $variables = []): string
    {
        $fullPath = __DIR__ . '/../views/' . $viewPath . '.php';

        if (!file_exists($fullPath)) {
            throw new \Exception('View file not found: ' . $fullPath);
        }

        extract($variables);

        ob_start();
        include $fullPath;
        return ob_get_clean();
    }
}