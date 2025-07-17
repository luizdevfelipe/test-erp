<?php
require_once __DIR__ . '/vendor/autoload.php';

use App\controllers\ProductController;
use App\Core\Application;
use App\Core\Router;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/docker');
$dotenv->load();

$app = new Application();

$router = new Router();

$router->get('/produto/create', [ProductController::class, 'createView']);

$response = $router->dispatch('/produto/create', 'GET');

echo $response ?? 'No response found for the route.';