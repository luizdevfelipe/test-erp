<?php

namespace App\Tests\Controller;

use App\Core\View;
use App\Tests\BaseTestCase;

class ViewTest extends BaseTestCase
{
    public function test_return_create_product_view(): void
    {
        $response = View::render('product/create');

        ob_start();
        include __DIR__ . '/../../views/product/create.php';
        $output = ob_get_clean();

        $this->assertIsString(
            $response,
            $output
        );
    }
}
