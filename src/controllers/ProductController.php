<?php

namespace App\controllers;

use App\Core\View;
use App\Core\Request;
use App\Core\Validation;
use App\services\ProductService;

class ProductController
{
    public function __construct(
        private readonly Request $request,
        private readonly Validation $validator,
        private readonly ProductService $productService
    ) {}

    public function productView()
    {
        $products = $this->productService->getAllProducts();

        var_dump($products);

        return View::render('product/create', ['products' => $products]);
    }

    public function createNewProduct()
    {
        $data = $this->request->post();

        $errors = $this->validator->validate($data, [
            'name' => ['required', 'string'],
            'price' => ['required', 'float'],
            'stock' => ['required', 'integer'],
        ]);

        if (isset($data['variations']) && is_array($data['variations'])) {
            foreach ($data['variations'] as $variation) {
                $errors = array_merge($errors, $this->validator->validate($variation, [
                    'name' => ['required', 'string'],
                    'price' => ['float:null'],
                    'stock' => ['required', 'integer'],
                ]));
            }
        }

        if (!empty($errors)) {
            return View::render('product/create', [
                'errors' => $errors,
                'data' => $data
            ]);
        }

        $this->productService->createProduct($data);

        return View::render('product/create', [
            'success' => 'Produto criado com sucesso!',
            'data' => $data
        ]);
    }

    public function listProducts()
    {
        // Acessar parâmetros de query string
        $page = $this->request->get('page', 1);
        $limit = $this->request->get('limit', 10);
        $search = $this->request->get('search', '');

        // Ou pegar apenas campos específicos
        // $filters = $this->request->only(['search', 'category', 'status']);

        // Lógica para buscar produtos com filtros
        // ... lógica de busca ...

        return View::render('product/list', [
            'products' => [], // dados dos produtos
            'pagination' => [
                'page' => $page,
                'limit' => $limit,
                'total' => 0
            ],
            // 'filters' => $filters
        ]);
    }
}
