<?php declare(strict_types=1);

namespace App\Models;

use App\Services\Product\CreateProductRequest;

abstract class Product
{
    protected string $sku;
    protected string $name;
    protected float $price;
    protected string $measurementUnit;
    protected string $currency = '$';
    protected array $allAttributes;

    public function __construct(CreateProductRequest $request)
    {
        $this->sku = $request->getSku();
        $this->name = $request->getName();
        $this->price = (float)$request->getPrice();
        $this->allAttributes = $request->all();
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