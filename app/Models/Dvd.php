<?php declare(strict_types=1);

namespace App\Models;

class Dvd extends Product
{
    private int $size;

    public function __construct(array $attributes)
    {
        parent::__construct($attributes);

        $this->size = (int )$attributes['size'];
        $this->measurementUnit = 'MB';
    }

    public function getSize(): int
    {
        return $this->size;
    }

}