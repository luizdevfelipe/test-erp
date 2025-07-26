<?php

namespace App\models;

use App\models\BaseModel;

class ProductVariationsModel extends BaseModel
{
    protected static string $table = 'variacoes_produto';

    public static function selectJoin(): array
    {
        $query = "SELECT
            p.id AS produto_id,
            p.nome AS produto_nome,
            p.quantidade as produto_quantidade,
            p.preco as produto_preco,
            GROUP_CONCAT(CONCAT(v.id, ':', v.nome, ':', v.preco) SEPARATOR '|') AS variations
        FROM produtos AS p
        LEFT JOIN variacoes_produto AS v ON v.produto_id = p.id
        GROUP BY p.id
        ORDER BY p.id;";
        return self::query($query);
    }
}
