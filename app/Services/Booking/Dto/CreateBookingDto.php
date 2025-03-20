<?php

namespace App\Services\Booking\Dto;

class CreateBookingDto
{

    public function __construct(
        public int $resourceId,
        public int $userId,
        public string $startTime,
        public string $endTime,
    )
    {
    }
}
