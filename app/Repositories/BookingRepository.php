<?php

namespace App\Repositories;

use App\Models\Booking;
use App\Repositories\Interfaces\BookingRepositoryInterface;
use App\Services\Booking\Dto\CreateBookingDto;
use App\Services\Booking\Dto\DeleteBookingDto;
use App\Services\Resource\Dto\GetResourceBookingsDto;
use Illuminate\Support\Collection;

class BookingRepository implements BookingRepositoryInterface
{
    /**
     * Create booking
     *
     * @param CreateBookingDto $createBookingDto
     * @return bool
     */
    public function create(CreateBookingDto $createBookingDto): bool
    {
        if (Booking::create([
            'resource_id' => $createBookingDto->resourceId,
            'user_id' => $createBookingDto->userId,
            'start_time' => $createBookingDto->startTime,
            'end_time' => $createBookingDto->endTime
        ])) {
            return true;
        }

        return false;
    }

    /**
     * Delete booking
     *
     * @param DeleteBookingDto $deleteBookingDto
     * @return bool
     */
    public function delete(DeleteBookingDto $deleteBookingDto): bool
    {
        return Booking::destroy($deleteBookingDto->id);
    }

    /**
     * Get all bookings that belongs to resource
     *
     * @param GetResourceBookingsDto $getResourceBookingsDto
     * @return Collection
     */
    public function getBookings(GetResourceBookingsDto $getResourceBookingsDto): Collection
    {
        return Booking::where('resource_id', $getResourceBookingsDto->resourceId)
            ->get();
    }

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
    ): Booking|null
    {
        return Booking::where('resource_id', $resourceId)
            ->where(function ($query) use ($startDate, $endDate) {
                $query->whereBetween('start_time', [$startDate, $endDate])
                      ->orWhereBetween('end_time', [$startDate, $endDate]);
            })
            ->first();
    }
}
