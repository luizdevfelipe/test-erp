<?php

namespace App\services;

use App\models\ProductModel;
use App\models\ProductVariationsModel;
use App\models\StockModel;

class ProductService
{
    public function createProduct(array $data): void
    {
        $id = ProductModel::insertId([
            'nome' => $data['name'],
            'preco' => $data['price'],
            'quantidade' => $data['stock']
        ]);

        if (isset($data['variation'])) {
            foreach ($data['variation']['name'] as $index => $name) {
                $variationId = ProductVariationsModel::insertId([
                    'produto_id' => $id,
                    'nome' => $name,
                    'preco' => (int) $data['variation']['price'][$index] ?: $data['price']
                ]);

                StockModel::insert([
                    'variacao_id' => $variationId,
                    'quantidade' => (int) $data['variation']['stock'][$index],
                ]);
            }
        }
    }

    public function getAllProducts(): array
    {
        return ProductVariationsModel::selectJoin();
    }
}   
