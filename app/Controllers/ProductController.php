<?php declare(strict_types=1);

namespace App\Controllers;

use App\Exceptions\InvalidInputException;
use App\Services\Product\{CreateProductService, DeleteProductService, IndexProductService, ValidateProductService};
use App\Core\Response\{Redirect, Response, Validation, View};
use App\Exceptions\ProductAlreadyExistsException;
use App\Core\Session;
use App\Core\Validator;

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
        foreach ($_POST as $key => $value) {
            Session::flash($key, $value);
        }

        try {
            Validator::form($_POST);
            $this->createProductService->execute($_POST);
            return new Redirect('/');
        } catch (ProductAlreadyExistsException | InvalidInputException $e) {
            return new Redirect('/add-product');
        }
    }

    public function delete(): Redirect
    {
        if (empty($_POST['delete'])) {
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
        } catch (ProductAlreadyExistsException $e) {
            $response = false;
        }
        return new Validation($response);
    }
}