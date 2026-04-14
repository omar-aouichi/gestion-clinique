<?php

namespace App\Repositories\Mock;

use App\DTOs\InterventionDTO;
use App\Enums\InterventionState;
use App\Repositories\Interfaces\InterventionRepositoryInterface;
use Illuminate\Support\Collection;

class MockInterventionRepository implements InterventionRepositoryInterface
{
    private static ?Collection $interventions = null;

    public function __construct()
    {
        if (self::$interventions === null) {
            self::$interventions = collect([
                new InterventionDTO(
                    1, 1, 1, null, null,
                    InterventionState::PLANIFIEE,
                    'Aouichi Omar', 'Dr. Alami', '2026-04-15'
                ),
                new InterventionDTO(
                    2, 2, 2, 1, 'Examen ORL satisfaisant.',
                    InterventionState::TERMINEE,
                    'Benzema Karim', 'Dr. Fassi', '2026-04-10'
                ),
                new InterventionDTO(
                    3, 1, 1, null, null,
                    InterventionState::PLANIFIEE,
                    'Aouichi Omar', 'Dr. Alami', '2026-04-20'
                ),
            ]);
        }
    }

    public function getAll(): Collection
    {
        return self::$interventions;
    }

    public function findById(int $id)
    {
        return self::$interventions->first(fn($i) => $i->id === $id);
    }

    public function findByDossierId(int $dossierId): Collection
    {
        return self::$interventions->filter(fn($i) => $i->dossier_id === $dossierId);
    }

    public function create(array $data)
    {
        $id = (self::$interventions->max('id') ?? 0) + 1;
        $intervention = new InterventionDTO(
            $id,
            $data['dossier_id'],
            $data['medecin_id'],
            $data['infirmier_id'] ?? null,
            $data['compte_rendu'] ?? null,
            $data['state'] ?? InterventionState::PLANIFIEE,
            $data['patient_nom'] ?? null,
            $data['medecin_nom'] ?? null,
            $data['date'] ?? now()->toDateString()
        );
        self::$interventions->push($intervention);
        return $intervention;
    }

    public function update(int $id, array $data)
    {
        $intervention = $this->findById($id);
        if ($intervention) {
            foreach ($data as $key => $value) {
                if (property_exists($intervention, $key)) {
                    $intervention->{$key} = $value;
                }
            }
        }
        return $intervention;
    }
}
