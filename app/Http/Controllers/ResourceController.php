<?php

namespace App\Http\Controllers;

use App\Http\Resources\ResourceResource;
use App\Models\Resource;
use App\Http\Requests\StoreResourceRequest;
use App\Services\Resource\Dto\CreateResourceDto;
use App\Services\Resource\Interfaces\ResourcesServiceInterface;

/**
 * @OA\Info(
 *     title="Resources Booking API",
 *     version="1.0.0",
 *     description="API для создания Resources и их бронирования(Bookings)"
 * )
 */
class ResourceController extends Controller
{
    /**
     * @OA\Get(
     *      path="/api/resources",
     *      summary="Получение списка всех Resources",
     *      @OA\Response(
     *          response=200,
     *          description="Успешный вызов",
     *          @OA\JsonContent(
     *              @OA\Schema(ref="#/components/schemas/getAllResourcesResult")
     *          )
     *      )
     *  )
     *
     *
     * @OA\Schema(
     *     schema="getAllResourcesResult",
     *     @OA\Property(property="success", type="bool", example="true"),
     *     @OA\Property(
     *              property="data",
     *              type="object",
     *              @OA\Property(property="id", type="integer", example="1"),
     *              @OA\Property(property="name", type="string", example="Standard room"),
     *              @OA\Property(property="type", type="string", example="room"),
     *              @OA\Property(property="description", type="string", example="resource description"),
     *              @OA\Property(property="created_at", type="string", format="date-time", description="Initial creation timestamp"),
     *              @OA\Property(property="updated_at", type="string", format="date-time", description="Last update timestamp")
     *          )
     * )
     * Display a listing of the resource.
     *
     * @param ResourcesServiceInterface $resourcesService
     * @return ResourceResource
     *
     */
    public function index(ResourcesServiceInterface $resourcesService): ResourceResource
    {
        return new ResourceResource(
            $resourcesService->getResources()
        );
    }

    /**
     * @OA\Post(
     *      path="/api/resources",
     *      summary="Создание нового Resource",
     *      @OA\RequestBody(
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(property="name", type="string", example="Standard room"),
     *              @OA\Property(property="type", type="string", example="room"),
     *              @OA\Property(property="description", type="string", example="resource description")
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Успешный вызов",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(property="success", type="bool", example="true"),
     *              @OA\Property(property="data", type="null", example="null")
     *          )
     *      )
     * )
     *
     * Store a newly created resource in storage.
     *
     * @param StoreResourceRequest $request
     * @param ResourcesServiceInterface $resourcesService
     * @return ResourceResource
     */
    public function store(
        StoreResourceRequest $request,
        ResourcesServiceInterface $resourcesService
    ): ResourceResource
    {
        return new ResourceResource(
            $resourcesService->createResource(
                new CreateResourceDto(
                    $request->get('name'),
                    $request->get('type'),
                    $request->get('description', ''),
                )
            )
        );
    }

    /**
     * @OA\Get(
     *      path="/api/resources/{resourceId}/bookings",
     *      summary="Получение всех bookings для resource",
     *      @OA\Response(
     *          response=200,
     *          description="Успешный вызов",
     *          @OA\JsonContent(
     *              @OA\Schema(ref="#/components/schemas/getAllBookingsForResourceResult")
     *          )
     *      )
     * )
     *
     * @OA\Schema(
     *      schema="getAllBookingsForResourceResult",
     *      @OA\Property(property="success", type="bool", example="true"),
     *      @OA\Property(
     *               property="data",
     *               type="object",
     *               @OA\Property(property="id", type="integer", example="1"),
     *               @OA\Property(property="resource_id", type="integer", example="1"),
     *               @OA\Property(property="user_id", type="integer", example="1"),
     *               @OA\Property(property="start_time", type="string", format="date-time", description="Начало бронирования"),
     *               @OA\Property(property="end_time", type="string", format="date-time", description="Конец бронирования"),
     *               @OA\Property(property="created_at", type="string", format="date-time", description="Initial creation timestamp"),
     *               @OA\Property(property="updated_at", type="string", format="date-time", description="Last update timestamp")
     *           )
     *  )
     *
     * Get bookings list for a resource
     *
     * @param Resource $resource
     * @param ResourcesServiceInterface $resourcesService
     * @return ResourceResource
     */
    public function getBookings(
        Resource $resource,
        ResourcesServiceInterface $resourcesService
    ): ResourceResource {
        return new ResourceResource(
            $resourcesService->getBookings($resource->id)
        );
    }

}
