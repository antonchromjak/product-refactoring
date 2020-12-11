<?php

namespace App\Controller;

use App\Log;
use App\Model\Brand;
use App\Model\Product;

class ProductController extends AbstractController
{
    protected function getName()
    {
        return 'product';
    }

    protected function getData()
    {
        $name = (empty($_GET['name'])) ? '' : $_GET['name'];
        $brand = (empty($_GET['brand'])) ? '' : $_GET['brand'];
        $order = (empty($_GET['order'])) ? 'id' : $_GET['order'];
        $limit = (empty($_GET['limit'])) ? 10 : $_GET['limit'];

        Log::info(sprintf('Rendering products action.'), $_GET);

        $brandModel = new Brand();
        $brands = $brandModel->load();

        $productModel = new Product();
        $products = $productModel->load($name, $brand, $order, 'ASC', $limit);

        foreach ($products as $key => $product) {
            $products[$key]['sum_price'] = $product['price'] * $product['quantity'];
            $products[$key]['sum_reserved_price'] = $product['price'] * $product['reserved'];
        }

        return [
            'title' => 'Products',
            'products' => $products,
            'brands' => $brands,
        ];
    }
}
