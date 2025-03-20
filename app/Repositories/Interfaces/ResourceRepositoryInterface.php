<?php

namespace App\Repositories\Interfaces;

use App\Models\Resource;
use App\Services\Resource\Dto\CreateResourceDto;
use Illuminate\Support\Collection;

interface ResourceRepositoryInterface
{
    /**
     * Get all Resources
     *
     * @return Resource[]
     */
    public function getAll(): Collection;

    /**
     * Create resource
     *
     * @param CreateResourceDto $createResourceDto
     * @return bool
     */
    public function create(CreateResourceDto $createResourceDto): bool;
}
