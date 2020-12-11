<?php

namespace App\Model;

class Product extends Model
{
    public function load($name = '', $brandId = '', $order = 'id', $direction = 'ASC', $limit = 10)
    {
        $sql = <<<SQL
SELECT p.*, b.name AS brand FROM products p
JOIN brands b on p.brand_id = b.id
SQL;

        if ('' !== $name || '' !== $brandId) {
            $where = [];
            if ('' !== $name) {
                $where[] = "p.name LIKE '%$name%'";
            }

            if ('' !== $brandId) {
                $where[] = "b.id = $brandId";
            }

            $sql .= " WHERE " . implode(" AND ", $where);
        }



        $sql = $this->addCommonParts($sql, $order, $direction, $limit);

        return $this->fetch($sql);
    }
}
