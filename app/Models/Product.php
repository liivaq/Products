<?php declare(strict_types=1);

namespace App\Models;

abstract class Product
{
    protected string $sku;
    protected string $name;
    protected string $type;
    protected float $price;
    protected string $measurementUnit;
    protected string $currency = '$';
    protected array $allAttributes;

    public function __construct(array $attributes, string $type)
    {
        $this->sku = $attributes['sku'];
        $this->name = $attributes['name'];
        $this->price = (float)$attributes['price'];
        $this->allAttributes = $attributes;
        $this->allAttributes['type'] = $type;
    }

    public function getSku(): string
    {
        return $this->sku;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function getAllAttributes(): array
    {
        return $this->allAttributes;
    }

    public function getMeasurementUnit(): string
    {
        return $this->measurementUnit;
    }

    public function getCurrency(): string
    {
        return $this->currency;
    }
}