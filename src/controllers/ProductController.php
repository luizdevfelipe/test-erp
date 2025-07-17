<?php

namespace App\controllers;

use App\Core\View;
use App\Core\Request;

class ProductController
{
    public function __construct(private readonly Request $request) {}

    public function createProductView()
    {
        return View::render('product/create');
    }

    public function createNewProduct()
    {
        // Acessar dados específicos do POST
        $name = $this->request->post('name');
        $price = $this->request->post('price');

        // Ou pegar todos os dados do POST
        $postData = $this->request->post();

        // Validar os dados
        if (empty($name) || empty($price)) {
            return View::render('product/create', [
                'error' => 'Nome e preço são obrigatórios',
                'data' => $postData
            ]);
        }

        // Processar criação do produto
        // ... lógica de criação ...

        return View::render('product/create', [
            'success' => 'Produto criado com sucesso!',
            'data' => $postData
        ]);
    }

    public function listProducts()
    {
        // Acessar parâmetros de query string
        $page = $this->request->get('page', 1);
        $limit = $this->request->get('limit', 10);
        $search = $this->request->get('search', '');

        // Ou pegar apenas campos específicos
        $filters = $this->request->only(['search', 'category', 'status']);

        // Lógica para buscar produtos com filtros
        // ... lógica de busca ...

        return View::render('product/list', [
            'products' => [], // dados dos produtos
            'pagination' => [
                'page' => $page,
                'limit' => $limit,
                'total' => 0
            ],
            'filters' => $filters
        ]);
    }
}
