<?php

namespace App\Services\Resource;

use App\Repositories\Interfaces\BookingRepositoryInterface;
use App\Repositories\Interfaces\ResourceRepositoryInterface;
use App\Services\Dto\ResponseDto;
use App\Services\Resource\Dto\CreateResourceDto;
use App\Services\Resource\Dto\GetResourceBookingsDto;
use App\Services\Resource\Interfaces\ResourcesServiceInterface;

class ResourcesService implements ResourcesServiceInterface
{

    public function __construct(
        private ResourceRepositoryInterface $resourceRepository,
        private BookingRepositoryInterface $bookingRepository
    )
    {
    }

    /**
     * Gets all resources
     *
     * @return ResponseDto
     */
    public function getResources(): ResponseDto
    {
        return new ResponseDto(
            true,
            $this->resourceRepository->getAll()
        );
    }

    /**
     * Create resource
     *
     * @param CreateResourceDto $createResourceDto
     * @return ResponseDto
     */
    public function createResource(CreateResourceDto $createResourceDto): ResponseDto
    {
        try {
            $success = $this->resourceRepository->create($createResourceDto);
        } catch (\Throwable $e) {
            return new ResponseDto(
                false,
                $e->getMessage(),
            );
        }

        return new ResponseDto($success);
    }

    /**
     * Gets all bookings that belongs to resource
     *
     * @param int $id
     * @return ResponseDto
     */
    public function getBookings(int $id): ResponseDto
    {
        try {
            $data = $this->bookingRepository->getBookings(
                new GetResourceBookingsDto($id)
            );
        } catch (\Throwable $e) {
            return new ResponseDto(
                false,
                $e->getMessage(),
            );
        }

        return new ResponseDto(
            true,
            $data
        );
    }

}
