<?php

namespace App\Model;

use App\DB;

abstract class Model
{
    /**
     * @var DB
     */
    private $db;

    protected function addCommonParts($sql, $order = 'id', $direction = 'ASC', $limit = 10)
    {
        if ("" !== $order) {
            $sql .= " ORDER BY $order $direction";
        }

        $sql .= " LIMIT $limit";

        return $sql;
    }

    protected function fetch($sql)
    {
        $stmt = $this->getDb()
            ->query($sql);

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    protected function getDb()
    {
        if (null === $this->db) {
            $this->db = DB::getInstance();
        }

        return $this->db;
    }
}
