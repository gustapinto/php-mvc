<?php

require_once '../framework/Controller.php';

class IndexController extends Controller
{
    public function index()
    {
        return $this->view('index');
    }
}