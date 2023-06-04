<?php declare(strict_types=1);

namespace App\Models;

class Book extends Product
{
    private int $weight;

    public function __construct(array $attributes)
    {
        parent::__construct($attributes);

        $this->weight = (int)$attributes['weight'];
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