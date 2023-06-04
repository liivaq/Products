<?php declare(strict_types=1);

namespace App\Models;

abstract class Product
{
    protected string $sku;
    protected string $name;
    protected int $price;
    protected string $type;
    protected array $allAttributes;
    protected array $customAttributes = [];

    public function __construct(array $attributes)
    {
        $this->allAttributes = $attributes;
        $this->sku = $attributes['sku'];
        $this->name = $attributes['name'];
        $this->price = (int)$attributes['price'];
        $this->type = $attributes['type'];
    }

    public function getSku(): string
    {
        return $this->sku;
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

    public function getCustomAttributes(): array
    {
        return $this->customAttributes;
    }
}