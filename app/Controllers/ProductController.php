<?php declare(strict_types=1);

namespace App\Controllers;

use App\Core\Redirect;
use App\Core\Response;
use App\Core\InputValidator;
use App\Core\Session;
use App\Core\Validator;
use App\Core\View;

use App\Exceptions\ProductAlreadyExistsException;
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
        foreach ($_POST as $key => $value){
            Session::flash($key, $value);
        }

        if(Validator::form($_POST)){
            return new Redirect('/add-product');
        };

        try{
            $this->createProductService->execute(new CreateProductRequest($_POST));
        }catch(ProductAlreadyExistsException $e){
            Session::flash('errors', 'Product with this SKU already exists');
            return new Redirect('/add-product');
        }
        return new Redirect('/');
    }

    public function delete(): Redirect
    {
        $this->deleteProductService->execute($_POST);
        return new Redirect('/');
    }

    public function validateSku(): InputValidator
    {
        $response = $this->validateProductService->execute($_POST['sku']);
        return new InputValidator($response);
    }

}