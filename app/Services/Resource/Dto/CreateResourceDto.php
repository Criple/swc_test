<?php

namespace App\Services\Resource\Dto;

class CreateResourceDto
{

    public function __construct(
        public string $name,
        public string $type,
        public string $description = '',
    )
    {
    }
}
