<?php

namespace App\tests\Controller;

use App\controllers\ProductController;
use App\Core\Application;
use App\Tests\BaseTestCase;

class ProductControllerTest extends BaseTestCase
{
    private ProductController $controller;

    public function setUp(): void
    {
        parent::setUp();
        $this->controller = Application::getContainer()->get(ProductController::class);
    }
}