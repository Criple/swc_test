<?php

namespace App\Services\Resource\Interfaces;

use App\Services\Dto\ResponseDto;
use App\Services\Resource\Dto\CreateResourceDto;

interface ResourcesServiceInterface
{

    /**
     * Gets all resources
     *
     * @return ResponseDto
     */
    public function getResources(): ResponseDto;

    /**
     * Create resource
     *
     * @param CreateResourceDto $createResourceDto
     * @return ResponseDto
     */
    public function createResource(CreateResourceDto $createResourceDto): ResponseDto;

    /**
     * Gets all bookings that belongs to resource
     *
     * @param int $id
     * @return ResponseDto
     */
    public function getBookings(int $id): ResponseDto;

}
