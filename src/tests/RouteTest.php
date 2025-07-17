<?php

namespace App\Tests;

use PHPUnit\Framework\TestCase;
use \App\Core\Router;

class RouteTest extends TestCase
{
    private $router;

    public function setUp(): void
    {
        parent::setUp();
        $this->router = new Router();
    }

    public function test_defining_get_route_with_controller (): void
    {
        $class = new class() {
            function createView() {
                return 'createView called';
            }
        };

        $this->router->get('/produto/create', [$class, 'createView']);

        $this->assertEquals(
            'createView called',
            $this->router->dispatch('/produto/create', 'GET')
        );
    }
}