<?php declare(strict_types=1);

namespace App\Core;

class InputValidator implements Response
{
    private bool $response;

    public function __construct(bool $response)
    {
        $this->response = $response;
    }

    public function isResponse(): bool
    {
        return $this->response;
    }

}