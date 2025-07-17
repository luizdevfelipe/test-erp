<?php
require_once __DIR__ . '/../../vendor/autoload.php';

use App\controllers\ProductController;
use App\Core\Application;
use App\Core\Router;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../../docker');
$dotenv->load();

$app = new Application();

$router = new Router();

$router->get('/', [ProductController::class, 'createProductView']);
$router->post('/produto', [ProductController::class, 'createProduct']);
$router->get('/produtos', [ProductController::class, 'listProducts']);

$response = $router->dispatch($_SERVER["REQUEST_URI"], $_SERVER["REQUEST_METHOD"]);

echo $response ?? 'No response found for the route.';