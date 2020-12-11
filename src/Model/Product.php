<?php

namespace App\Model;

class Product extends Model
{
    public function loadWithSums($name = '', $brandId = '', $order = 'id', $direction = 'ASC', $limit = 10)
    {
        $sql = <<<SQL
SELECT 
    p.*, 
    b.name AS brand,
    p.price * p.quantity as sum_price, 
    p.price * p.reserved as sum_reserved_price 
FROM products p
JOIN brands b on p.brand_id = b.id
SQL;

        if ('' !== $name || '' !== $brandId) {
            $where = [];
            if ('' !== $name) {
                $where[] = "p.name LIKE CONCAT('%', :name, '%')";
            }

            if ('' !== $brandId) {
                $where[] = "b.id = :brandId";
            }

            $sql .= " WHERE " . implode(" AND ", $where);
        }
        if ("" !== $order) {
            $sql .= " ORDER BY :order :direction";
        }
        $sql .= " LIMIT :limit ";

        $dbh = $this->getDb();
        $sth = $dbh->prepare($sql);
        if ('' !== $name) {
            $sth->bindParam(':name', $name);
        }
        if ('' !== $brandId) {
            $sth->bindParam(':brandId', $brandId, \PDO::PARAM_INT);
        }
        if ('' !== $order) {
            $sth->bindParam(':order', $order);
            $sth->bindParam(':direction', $direction);
        }
        $sth->bindParam(':limit', $limit, \PDO::PARAM_INT);

        $sth->execute();
        return $sth->fetchAll(\PDO::FETCH_ASSOC);
    }
}
