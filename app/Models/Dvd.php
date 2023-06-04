<?php declare(strict_types=1);

namespace App\Models;

class Dvd extends Product
{
    protected int $size;

    public function __construct(array $attributes)
    {
        parent::__construct($attributes);

        $this->size = (int)$attributes['size'];
        $this->customAttributes['Size'] = $this->size.' MB';
    }

    public function getSize(): int
    {
        return $this->size;
    }

    public function setSize(int $size): void
    {
        $this->size = $size;
    }

}