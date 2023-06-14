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

    public function __construct(array $attributes)
    {
        $this->sku = $attributes['sku'];
        $this->name = $attributes['name'];
        $this->price = (float)$attributes['price'];
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

    public function getPrice(): float
    {
        return $this->price;
    }

    public function getType(): string
    {
        return $this->type;
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