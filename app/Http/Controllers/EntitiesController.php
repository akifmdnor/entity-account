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

    public function index()
    {
        $this->entityService->getAllEntities();
    }

    public function show(string $id)
    {
        $entity = $this->entityService->getEntityById($id);
        if ($entity == null) {
            return response()->json(['error' => 'Entity not found']);
        }
        $currentBalance = $this->entityService->getEntityBalance($id);
        return response()->json(['entity' => $entity, 'current_balance' => $currentBalance]);
    }
}
