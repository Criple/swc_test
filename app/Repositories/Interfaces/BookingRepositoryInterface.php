<?php

namespace App\Repositories\Interfaces;

use App\Models\Booking;
use App\Services\Booking\Dto\CreateBookingDto;
use App\Services\Booking\Dto\DeleteBookingDto;
use App\Services\Resource\Dto\GetResourceBookingsDto;
use Illuminate\Support\Collection;

interface BookingRepositoryInterface
{

    /**
     * Create booking
     *
     * @param CreateBookingDto $createBookingDto
     * @return bool
     */
    public function create(CreateBookingDto $createBookingDto): bool;

    /**
     * Delete booking
     *
     * @param DeleteBookingDto $deleteBookingDto
     * @return bool
     */
    public function delete(DeleteBookingDto $deleteBookingDto): bool;

    /**
     * Get all bookings that belongs to resource
     *
     * @param GetResourceBookingsDto $getResourceBookingsDto
     * @return Collection
     */
    public function getBookings(GetResourceBookingsDto $getResourceBookingsDto): Collection;

    /**
     * Gets booking on given dates
     *
     * @param int $resourceId
     * @param string $startDate
     * @param string $endDate
     * @return Booking|null
     */
    public function getResourceBookingToDates(
        int $resourceId,
        string $startDate,
        string $endDate,
    ): Booking|null;
}
