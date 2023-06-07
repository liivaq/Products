<?php declare(strict_types=1);

namespace App\Models;

use App\Services\Product\CreateProductRequest;

class Dvd extends Product
{
    protected int $size;

    public function __construct(CreateProductRequest $request)
    {
        parent::__construct($request);

        $this->size = (int )$request->getSize();
        $this->measurementUnit = 'MB';
    }

    public function getSize(): int
    {
        return $this->size;
    }

}