<?php declare(strict_types=1);

namespace App\Models;

class Furniture extends Product
{
    protected int $height;
    protected int $width;
    protected int $length;

    public function __construct(array $attributes)
    {
        parent::__construct($attributes);

        $this->height = (int)$attributes['height'];
        $this->length = (int) $attributes['length'];
        $this->width = (int)$attributes['width'];

        $this->customAttributes['Dimensions'] = $this->height.'x'.$this->length.'x'.$this->width;
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