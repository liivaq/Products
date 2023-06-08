<?php declare(strict_types=1);

namespace App\Controllers;

use App\Core\Redirect;
use App\Core\Response;
use App\Core\SkuValidator;
use App\Core\View;

use App\Services\Product\CreateProductRequest;
use App\Services\Product\CreateProductService;
use App\Services\Product\DeleteProductService;
use App\Services\Product\IndexProductService;
use App\Services\Product\ValidateProductService;

class ProductController
{
    private CreateProductService $createProductService;
    private IndexProductService $indexProductService;
    private DeleteProductService $deleteProductService;

    private ValidateProductService $validateProductService;

    public function __construct()
    {
        $this->createProductService = new CreateProductService();
        $this->indexProductService = new IndexProductService();
        $this->deleteProductService = new DeleteProductService();
        $this->validateProductService = new ValidateProductService();
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


    public function create(): Response
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

    public function validateSku(): SkuValidator
    {
        $response = $this->validateProductService->execute($_POST['sku']);
        return new SkuValidator($response);
    }

}