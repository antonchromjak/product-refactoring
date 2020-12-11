<?php

namespace App\Model;

class Brand extends Model
{
    public function load()
    {
        $sql = <<<SQL
SELECT 
    b.id, 
    b.name 
FROM brands b
SQL;
        return $this->fetch($sql);
    }

    public function getStats()
    {
        $sql = <<<SQL
SELECT 
    b.name, 
    SUM(p.quantity) AS quantity, 
    SUM(p.reserved) AS reserved, 
    SUM(p.quantity * p.price) AS price_quantity, 
    SUM(p.reserved * p.price) AS price_reserved
FROM brands b
LEFT JOIN products p on b.id = p.brand_id
GROUP BY b.id
ORDER BY b.name
SQL;

        return $this->fetch($sql);
    }
}
