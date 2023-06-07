<?php declare(strict_types=1);

namespace App\Services\Product;

class CreateProductRequest
{
    private string $sku;
    private string $name;
    private string $price;
    private string $type;
    private ?string $size;
    private ?string $weight;
    private ?string $length;
    private ?string $height;
    private ?string $width;

    private array $all;

    public function __construct(array $attributes)
    {
        foreach ($attributes as $key => $attribute){
            if($attribute) {
                $this->{$key} = $attribute;
                $this->all[$key] = $attribute;
            }
        }
    }

    public function getSku(): string
    {
        return $this->sku;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPrice(): string
    {
        return $this->price;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getSize(): ?string
    {
        return $this->size;
    }

    public function getWeight(): ?string
    {
        return $this->weight;
    }

    public function getLength(): ?string
    {
        return $this->length;
    }

    public function getHeight(): ?string
    {
        return $this->height;
    }

    public function getWidth(): ?string
    {
        return $this->width;
    }

    public function all(): array
    {
        return $this->all;
    }
}