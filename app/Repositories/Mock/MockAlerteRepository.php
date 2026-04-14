<?php

namespace App\Repositories\Mock;

use App\DTOs\AlerteDTO;
use App\Repositories\Interfaces\AlerteRepositoryInterface;
use Illuminate\Support\Collection;

class MockAlerteRepository implements AlerteRepositoryInterface
{
    private static ?Collection $alerts = null;

    public function __construct()
    {
        if (self::$alerts === null) {
            self::$alerts = collect([
                new AlerteDTO(1, "Stock Critique: Seringues à usage unique", 5592, 'pending'),
                new AlerteDTO(2, "Expiration Proche: Paracétamol 500mg", 1102, 'pending'),
            ]);
        }
    }

    public function getAll(): Collection
    {
        return self::$alerts;
    }

    public function findById(int $id)
    {
        return self::$alerts->first(fn($a) => $a->id === $id);
    }

    public function create(array $data)
    {
        $newId = self::$alerts->isEmpty() ? 1 : self::$alerts->max('id') + 1;
        $alerte = new AlerteDTO(
            $newId,
            $data['message'],
            $data['equipement_id'],
            $data['status'] ?? 'pending'
        );
        self::$alerts->push($alerte);
        return $alerte;
    }

    public function markAsResolved(int $id)
    {
        $alerte = $this->findById($id);
        if ($alerte) {
            $alerte->status = 'resolved';
            return true;
        }
        return false;
    }
}
