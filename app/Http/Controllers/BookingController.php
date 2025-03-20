<?php

namespace App\Http\Controllers;

use App\Http\Resources\BookingResource;
use App\Models\Booking;
use App\Http\Requests\StoreBookingRequest;
use App\Services\Booking\Dto\CreateBookingDto;
use App\Services\Booking\Dto\DeleteBookingDto;
use App\Services\Booking\Interfaces\BookingsServiceInterface;

class BookingController extends Controller
{

    /**
     *
     * @OA\Post(
     *        path="/api/bookings",
     *        summary="Создание бронирования",
     *        @OA\RequestBody(
     *            @OA\JsonContent(
     *                type="object",
     *                @OA\Property(property="resource_id", type="integer", example="1"),
     *                @OA\Property(property="user_id", type="integer", example="1"),
     *                @OA\Property(property="start_time", type="string", format="date-time", description="Начало бронирования"),
     *                @OA\Property(property="end_time", type="string", format="date-time", description="Конец бронирования")
     *            )
     *        ),
     *        @OA\Response(
     *            response=200,
     *            description="Успешный вызов",
     *            @OA\JsonContent(
     *                type="object",
     *                @OA\Property(property="success", type="bool", example="true"),
     *                @OA\Property(property="data", type="null", example="null")
     *            )
     *        )
     *   )
     *
     * Store a newly created booking in storage.
     *
     * @param StoreBookingRequest $request
     * @param BookingsServiceInterface $bookingsService
     * @return BookingResource
     */
    public function store(
        StoreBookingRequest $request,
        BookingsServiceInterface $bookingsService
    ): BookingResource
    {
        return new BookingResource(
            $bookingsService->book(
                new CreateBookingDto(
                    $request->get('resource_id'),
                    $request->get('user_id'),
                    $request->get('start_time'),
                    $request->get('end_time'),
                )
            )
        );
    }

    /**
     * @OA\Delete(
     *     path="/api/bookings/{bookingId}",
     *     summary="Отмена бронирования",
     *     @OA\Response(
     *             response=200,
     *             description="Успешный вызов",
     *             @OA\JsonContent(
     *                 type="object",
     *                 @OA\Property(property="success", type="bool", example="true"),
     *                 @OA\Property(property="data", type="null", example="null")
     *             )
     *         )
     * )
     *
     * Remove the specified resource from storage.
     *
     * @param Booking $booking
     * @param BookingsServiceInterface $bookingsService
     * @return BookingResource
     */
    public function destroy(
        Booking $booking,
        BookingsServiceInterface $bookingsService
    ): BookingResource
    {
        return new BookingResource(
            $bookingsService->deleteBooking(
                new DeleteBookingDto($booking->id)
            )
        );
    }
}
