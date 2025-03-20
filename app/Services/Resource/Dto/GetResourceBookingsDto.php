<?php

namespace App\Services\Resource\Dto;

class GetResourceBookingsDto
{

    public function __construct(
        public int $resourceId,
    )
    {
    }
}
