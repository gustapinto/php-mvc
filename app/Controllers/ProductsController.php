<?php

require_once '../framework/Controller.php';

class ProductsController extends Controller
{
    public function index()
    {
        return $this->view('products/index');
    }

    public function new()
    {
        return $this->view('products/new');
    }
}
