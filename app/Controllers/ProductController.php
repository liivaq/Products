<?php declare(strict_types=1);

namespace App\Controllers;

use App\Core\View;

class ProductController
{
    public function index(): View
    {
        return new View('index');
    }

    public function show(): View
    {
        return new View('show');
    }

    public function create()
    {
        var_dump($_POST);
        die;
    }

}