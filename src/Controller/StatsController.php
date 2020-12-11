<?php

namespace App\Controller;

use App\Model\Brand;

class StatsController extends AbstractController
{
    protected function getData()
    {
        $brandModel = new Brand();

        return [
            'title' => 'Stats',
            'brands' => $brandModel->getStats(),
        ];
    }
}
