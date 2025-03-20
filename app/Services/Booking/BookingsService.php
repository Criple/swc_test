<?php

namespace App\Services\Booking;

use App\Repositories\Interfaces\BookingRepositoryInterface;
use App\Services\Booking\Dto\CreateBookingDto;
use App\Services\Booking\Dto\DeleteBookingDto;
use App\Services\Booking\Interfaces\BookingsServiceInterface;
use App\Services\Dto\ResponseDto;

class BookingsService implements BookingsServiceInterface
{

    public function __construct(
        private BookingRepositoryInterface $bookingRepository
    )
    {
    }

    /**
     * Create booking to resource
     *
     * @param CreateBookingDto $createBookingDto
     * @return ResponseDto
     * @throws \Exception
     */
    public function book(CreateBookingDto $createBookingDto): ResponseDto
    {
        $this->resourceHasBookingOnGivenDates(
            $createBookingDto->resourceId,
            $createBookingDto->startTime,
            $createBookingDto->endTime
        );

        return new ResponseDto(
            $this->bookingRepository->create($createBookingDto)
        );
    }

    /**
     * Delete booking
     *
     * @param DeleteBookingDto $deleteBookingDto
     * @return ResponseDto
     */
    public function deleteBooking(DeleteBookingDto $deleteBookingDto): ResponseDto
    {
        return new ResponseDto(
            $this->bookingRepository->delete($deleteBookingDto)
        );
    }

    /**
     * Check if resource already has a booking
     *
     * @throws \Exception
     */
    public function resourceHasBookingOnGivenDates(
        int $resourceId,
        string $startDate,
        string $endDate,
    ): void
    {
        if ($this->bookingRepository->getResourceBookingToDates(
            $resourceId,
            $startDate,
            $endDate
        )) {
            throw new \Exception('На выбранные даты уже есть бронирование.', 422);
        }
    }

}
