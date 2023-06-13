<?php

namespace App\Http\Controllers;

use App\Services\EntityService;

class EntitiesController extends Controller
{
    protected $entityService;

    public function __construct(EntityService $entityService)
    {
        $this->entityService = $entityService;
    }

    /**
     * @OA\Get(
     *     path="/entities",
     *     @OA\Response(response="200", description="Get list of all entities")
     * )
     */

    public function index()
    {
        $this->entityService->getAllEntities();
    }

    /**
     * @OA\Get(
     *     path="/entities/{id}",
     *     @OA\Response(response="200", description="Get info and balance of an entity"),
     *       @OA\Response(response=404, description="Resource Not Found"),
     * )
     */
    public function show(string $id)
    {
        $entity = $this->entityService->getEntityById($id);
        if ($entity == null) {
            return response()->json(['error' => 'Entity not found'],404);
        }
        $currentBalance = $this->entityService->getEntityBalance($id);
        return response()->json(['entity' => $entity, 'current_balance' => $currentBalance]);
    }
}
