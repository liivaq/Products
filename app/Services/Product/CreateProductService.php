<?php declare(strict_types=1);

namespace App\Services\Product;

use App\Repositories\ProductDatabaseRepository;

class CreateProductService
{
    private ProductDatabaseRepository $productDatabaseRepository;

    public function __construct()
    {
        $this->productDatabaseRepository = new ProductDatabaseRepository;
    }

    public function execute(string $type, array $attributes)
    {
        $productType = 'App\Models\\' . $type;
        $product = new $productType($attributes, $type);

        $this->productDatabaseRepository->save($product);
    }

}