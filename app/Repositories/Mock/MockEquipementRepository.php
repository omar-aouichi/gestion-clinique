<?php

namespace App\Repositories\Mock;

use App\DTOs\EquipementDTO;
use App\Enums\EquipementState;
use App\Repositories\Interfaces\EquipementRepositoryInterface;
use Illuminate\Support\Collection;

class MockEquipementRepository implements EquipementRepositoryInterface
{
    private Collection $equipements;

    public function __construct()
    {
        $this->equipements = collect([
            new EquipementDTO(2045, 'Défibrillateur Automatique', 'Équipement Médical', 14, 8500.00, '2028-10-15', EquipementState::VALIDE, 'High', 'Diagnostic', 'Reutilisable', 5),
            new EquipementDTO(1102, 'Paracétamol 500mg', 'Médicament', 250, 25.00, '2024-03-01', EquipementState::VALIDE, 'Low', 'Soutien', 'Unique', 50),
            new EquipementDTO(5592, 'Seringues à usage unique', 'Consommable', 0, 1.50, '2025-01-01', EquipementState::RETIRE, 'Low', 'Soutien', 'Unique', 100),
            new EquipementDTO(8831, 'Scanner IRM Lite v2', 'Équipement Médical', 2, 450000.00, '2030-01-01', EquipementState::VALIDE, 'Medium', 'Therapeutique', 'Reutilisable', 1),
            new EquipementDTO(9901, 'Gants Stériles (Taille M)', 'Consommable', 12, 120.00, '2027-05-20', EquipementState::VALIDE, 'Low', 'Soutien', 'Unique', 50),
            new EquipementDTO(3344, 'Masques FFP2', 'Consommable', 85, 45.00, '2026-12-30', EquipementState::VALIDE, 'Low', 'Soutien', 'Unique', 100),
        ]);
    }

    public function getAll(): Collection
    {
        return $this->equipements;
    }

    public function findById(int $id)
    {
        return $this->equipements->first(fn($eq) => $eq->id_equipement === $id);
    }

    public function updateQuantity(int $id, int $amount)
    {
        $equipement = $this->findById($id);
        if ($equipement) {
            $equipement->quantite += $amount;
            if ($equipement->quantite < 0) $equipement->quantite = 0;
            return true;
        }
        return false;
    }

    public function updateState(int $id, EquipementState $state)
    {
        $equipement = $this->findById($id);
        if ($equipement) {
            $equipement->etat = $state;
            return true;
        }
        return false;
    }
}
