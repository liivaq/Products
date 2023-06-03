<?php declare(strict_types=1);

namespace App\Models;

abstract class Product
{
    private string $SKU;
    private string $name;
    private int $price;

    public function __construct(string $SKU, string $name, int $price)
    {
        $this->SKU = $SKU;
        $this->name = $name;
        $this->price = $price;
    }

    public function getSKU(): string
    {
        return $this->SKU;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPrice(): int
    {
        return $this->price;
    }

}