<?php declare(strict_types=1);

namespace App\Services\Product;

use App\Repositories\ProductDatabaseRepository;

class DeleteProductService
{
    private ProductDatabaseRepository $productDatabaseRepository;

    public function __construct()
    {
        $this->productDatabaseRepository = new ProductDatabaseRepository;
    }

    public function execute(array $products)
    {
        $this->productDatabaseRepository->delete($products['delete']);
    }
}