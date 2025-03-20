<?php

namespace App\Services\Booking\Interfaces;

use App\Services\Booking\Dto\CreateBookingDto;
use App\Services\Booking\Dto\DeleteBookingDto;
use App\Services\Dto\ResponseDto;

interface BookingsServiceInterface
{

    /**
     * Create booking to resource
     *
     * @param CreateBookingDto $createBookingDto
     * @return ResponseDto
     */
    public function book(CreateBookingDto $createBookingDto): ResponseDto;

    /**
     * Delete booking
     *
     * @param DeleteBookingDto $deleteBookingDto
     * @return ResponseDto
     */
    public function deleteBooking(DeleteBookingDto $deleteBookingDto): ResponseDto;

}
