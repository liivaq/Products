<?php declare(strict_types=1);

namespace App\Models;

use App\Services\Product\CreateProductRequest;

class Book extends Product
{
    protected int $weight;

    public function __construct(CreateProductRequest $request)
    {
        parent::__construct($request);

        $this->weight = (int)$request->getWeight();
        $this->measurementUnit = 'KG';
    }

    public function getWeight(): int
    {
        return $this->weight;
    }

}