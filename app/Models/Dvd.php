<?php declare(strict_types=1);

namespace App\Models;

class Dvd extends Product
{
    protected int $size;

    public function __construct(array $attributes, string $type)
    {
        parent::__construct($attributes, $type);

        $this->size = (int )$attributes['size'];
        $this->measurementUnit = 'MB';
    }

    public function getSize(): int
    {
        return $this->size;
    }

}