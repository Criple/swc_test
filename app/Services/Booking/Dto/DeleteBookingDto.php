<?php

namespace App\Services\Booking\Dto;

class DeleteBookingDto
{

    public function __construct(
        public int $id,
    )
    {
    }
}
