<?php

namespace App\Repositories;

use App\Models\Resource;
use App\Services\Resource\Dto\CreateResourceDto;
use Illuminate\Support\Collection;
use App\Repositories\Interfaces\ResourceRepositoryInterface;

class ResourceRepository implements ResourceRepositoryInterface
{
    /**
     * Get all Resources
     *
     * @return Resource[]
     */
    public function getAll(): Collection
    {
        return Resource::all();
    }

    /**
     * Create resource
     *
     * @param CreateResourceDto $createResourceDto
     * @return bool
     */
    public function create(CreateResourceDto $createResourceDto): bool
    {
        if (
            Resource::create([
                'name' => $createResourceDto->name,
                'type' => $createResourceDto->type,
                'description' => $createResourceDto->description,
            ])
        ) {
            return true;
        }

        return false;
    }

}
