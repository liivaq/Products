<?php declare(strict_types=1);

namespace App\Models;

class Furniture extends Product
{
    private int $height;
    private int $width;
    private int $length;

    public function __construct(
        string $SKU,
        string $name,
        int    $price,
        int    $height,
        int    $width,
        int    $length
    )
    {
        parent::__construct($SKU, $name, $price);

        $this->height = $height;
        $this->length = $length;
        $this->width = $width;
    }

    public function getHeight(): int
    {
        return $this->height;
    }

    public function setHeight(int $height): void
    {
        $this->height = $height;
    }

    public function getWidth(): int
    {
        return $this->width;
    }

    public function setWidth(int $width): void
    {
        $this->width = $width;
    }

    public function getLength(): int
    {
        return $this->length;
    }

    public function setLength(int $length): void
    {
        $this->length = $length;
    }

}