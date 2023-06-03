<?php declare(strict_types=1);

namespace App\Models;

class Book extends Product
{
    private int $weight;

    public function __construct(string $SKU, string $name, int $price, $weight)
    {
        parent::__construct($SKU, $name, $price);

        $this->weight = $weight;
    }

    public function getWeight(): int
    {
        return $this->weight;
    }

    public function setWeight(int $weight): void
    {
        $this->weight = $weight;
    }
}