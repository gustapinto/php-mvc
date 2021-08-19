<?php

namespace App\Controllers;

use Framework\Controller;
use Framework\Helpers\Redirector;
use App\Models\ProductModel;

class ProductsController extends Controller
{
    public function index()
    {
        return $this->view('products.index');
    }

    public function new()
    {
        $productModel = new ProductModel();

        $productModel->create([
            'name' => (string) $_POST['name'],
            'value' => (float) $_POST['value'],
        ]);

        Redirector::redirect('/products');
    }
}
