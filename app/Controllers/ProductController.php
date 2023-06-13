<?php declare(strict_types=1);

namespace App\Controllers;

use App\Core\Response\Redirect;
use App\Core\Response\Response;
use App\Core\Response\Validation;
use App\Core\Response\View;
use App\Core\Session;
use App\Core\Validator;
use App\Exceptions\ProductAlreadyExistsException;
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

    public function create(): View
    {
        return new View('create');
    }

    public function store(): Response
    {
        foreach ($_POST['attributes'] as $key => $value) {
            Session::flash($key, $value);
        }

        if (Validator::form($_POST)) {
            return new Redirect('/add-product');
        };

        try {
            $this->createProductService->execute($_POST['type'], $_POST['attributes']);
        } catch (ProductAlreadyExistsException $e) {
            Session::flash('errors', 'Product with this SKU already exists');
            return new Redirect('/add-product');
        }
        return new Redirect('/');
    }

    public function delete(): Redirect
    {
        if(empty($_POST['delete'])){
            return new Redirect('/');
        }

        $this->deleteProductService->execute($_POST);
        return new Redirect('/');
    }

    public function validate(): Validation
    {
        try {
            $this->validateProductService->execute($_POST['sku']);
            $response = true;
        }catch(ProductAlreadyExistsException $e){
            $response = false;
        }
        return new Validation($response);
    }
}