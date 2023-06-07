<?php declare(strict_types=1);

namespace App\Controllers;

use App\Core\Redirect;
use App\Core\View;

use App\Models\Product;
use App\Services\Product\CreateProductRequest;
use App\Services\Product\CreateProductService;
use App\Models\Dvd;
use App\Models\Book;
use App\Models\Furniture;
use App\Services\Product\DeleteProductService;
use App\Services\Product\IndexProductService;
use Dotenv\Validator;

class ProductController
{
    private CreateProductService $createProductService;
    private IndexProductService $indexProductService;
    private DeleteProductService $deleteProductService;

    public function __construct()
    {
        $this->createProductService = new CreateProductService();
        $this->indexProductService = new IndexProductService();
        $this->deleteProductService = new DeleteProductService();
    }

    public function index(): View
    {
        $products = $this->indexProductService->execute();

        return new View('index', [
            'products' => $products
        ]);
    }

    public function show(): View
    {
        return new View('show');
    }


    public function create(): Redirect
    {

        $errors = \App\Core\Validator::form($_POST);

        $this->createProductService->execute(new CreateProductRequest($_POST));
        return new Redirect('/');
    }

    public function delete(): Redirect
    {
        $this->deleteProductService->execute($_POST);
        return new Redirect('/');
    }
}