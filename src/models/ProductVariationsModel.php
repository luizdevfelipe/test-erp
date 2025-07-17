<?php

namespace App\models;

use App\models\BaseModel;

class ProductVariationsModel extends BaseModel
{
    protected static string $table = 'variacoes_produto';

    public static function selectJoin(): array
    {
        $query = "SELECT 
            p.id as produto_id,
            p.nome as produto_nome,
            p.preco as produto_preco,
            p.quantidade as produto_quantidade,
            v.id as variacao_id,
            v.nome as variacao_nome,
            v.preco as variacao_preco
        FROM produtos AS p 
        LEFT JOIN " . self::$table . " AS v ON v.produto_id = p.id";
        return self::query($query);
    }
}
