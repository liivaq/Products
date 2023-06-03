<?php declare(strict_types=1);

namespace App\Models;

class DVD extends Product
{
    private int $size;

    public function __construct(string $SKU, string $name, int $price, $size)
    {
        parent::__construct($SKU, $name, $price);

        $this->size = $size;
    }

    public function getSize(): int
    {
        return $this->size;
    }

    public function setSize(int $size): void
    {
        $this->size = $size;
    }
}