<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\StockService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class StockController extends Controller
{
    public function __construct(
        protected StockService $stockService
    ) {}

    public function index(Request $request): JsonResponse
    {
        $critere = $request->query('classer_par');
        
        if ($critere) {
            $stock = $this->stockService->consulter_stock(); // Classer à faire plus tard si besoin
        } else {
            $stock = $this->stockService->consulter_stock();
        }

        return response()->json([
            'success' => true,
            'data' => $stock->values()->map(fn($eq) => $eq->toArray())
        ]);
    }

    public function mouvement(Request $request): JsonResponse
    {
        $request->validate([
            'id_equipement' => 'required|integer',
            'type' => 'required|in:entree,sortie',
            'quantite' => 'required|integer|min:1'
        ]);

        $result = $this->stockService->enregistrerMouvement(
            $request->id_equipement, 
            $request->type, 
            $request->quantite
        );

        return response()->json($result, $result['success'] ? 200 : 422);
    }

    public function pump(): JsonResponse
    {
        $pump = $this->stockService->calculer_PUMP();
        return response()->json([
            'success' => true,
            'pump' => $pump,
            'currency' => 'MAD'
        ]);
    }

    public function verifierExpiration(): JsonResponse
    {
        $result = $this->stockService->verifier_date_expiration();
        return response()->json($result);
    }

    public function checkThresholds(): JsonResponse
    {
        $result = $this->stockService->verifierSeuilMinimal();
        return response()->json($result);
    }

    public function listByCriteria(Request $request): JsonResponse
    {
        $criteria = $request->query('criteria', 'id');
        $stock = $this->stockService->classerEquipements($criteria);
        return response()->json([
            'success' => true,
            'data' => $stock->map(fn($eq) => $eq->toArray())
        ]);
    }
}
