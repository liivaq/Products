<?php declare(strict_types=1);

namespace App\Models;

use App\Services\Product\CreateProductRequest;

class Furniture extends Product
{
    protected int $height;
    protected int $width;
    protected int $length;

    public function __construct(CreateProductRequest $request)
    {
        parent::__construct($request);

        $this->height = (int) $request->getHeight();
        $this->length = (int) $request->getLength();
        $this->width = (int) $request->getWidth();
        $this->measurementUnit = 'CM';
    }

    public function getHeight(): int
    {
        return $this->height;
    }

    public function getWidth(): int
    {
        return $this->width;
    }

    public function getLength(): int
    {
        return $this->length;
    }

}