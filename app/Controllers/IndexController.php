<?php

namespace App\Controllers;

use Framework\Controller;

class IndexController extends Controller
{
    public function index()
    {
        return $this->view('index');
    }
}
