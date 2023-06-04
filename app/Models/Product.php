<?php declare(strict_types=1);

namespace App\Models;

abstract class Product
{
    private string $SKU;
    private string $name;
    private int $price;
    private string $type;
    private array $allAttributes;

    public function __construct(array $attributes)
    {
        $this->allAttributes = $attributes;
        $this->SKU = $attributes['sku'];
        $this->name = $attributes['name'];
        $this->price = (int)$attributes['price'];
        $this->type = $attributes['type'];
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

    public function getType(): string
    {
        return $this->type;
    }

    public function allAttributes(): array
    {
        return $this->allAttributes;
    }
}