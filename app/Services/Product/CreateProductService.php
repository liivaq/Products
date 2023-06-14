<?php declare(strict_types=1);

namespace App\Services\Product;

use App\Models\Product;
use App\Repositories\ProductDatabaseRepository;

class CreateProductService
{
    private ProductDatabaseRepository $productDatabaseRepository;

    public function __construct()
    {
        $this->productDatabaseRepository = new ProductDatabaseRepository;
    }

    public function execute(array $attributes)
    {
        $productType = 'App\Models\\' . $attributes['type'];

        /** @var Product $product */
        $product = new $productType($attributes);

        $this->productDatabaseRepository->save($product);
    }

}