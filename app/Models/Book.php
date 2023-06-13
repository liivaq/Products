<?php declare(strict_types=1);

namespace App\Models;

class Book extends Product
{
    protected int $weight;

    public function __construct(array $attributes, string $type)
    {
        parent::__construct($attributes, $type);

        $this->weight = (int)$attributes['weight'];
        $this->measurementUnit = 'KG';
    }

    public function getWeight(): int
    {
        return $this->weight;
    }

}