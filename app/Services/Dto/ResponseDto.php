<?php

namespace App\Services\Dto;

class ResponseDto
{

    public function __construct(
        public bool $success = false,
        public $data = null,
    )
    {
    }
}
