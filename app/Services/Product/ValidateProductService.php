<?php declare(strict_types=1);

namespace App\Services\Product;

use App\Repositories\ProductDatabaseRepository;

class ValidateProductService
{
    private ProductDatabaseRepository $productDatabaseRepository;

    public function __construct()
    {
        $this->productDatabaseRepository = new ProductDatabaseRepository();
    }

    public function execute(string $sku){
       return $this->productDatabaseRepository->authenticate($sku);
    }

}