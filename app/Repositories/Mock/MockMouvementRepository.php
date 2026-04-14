<?php

namespace App\Repositories\Mock;

use App\DTOs\MouvementDTO;
use App\Repositories\Interfaces\MouvementRepositoryInterface;
use Illuminate\Support\Collection;

class MockMouvementRepository implements MouvementRepositoryInterface
{
    private static ?Collection $mouvements = null;

    public function __construct()
    {
        if (self::$mouvements === null) {
            self::$mouvements = collect([
                new MouvementDTO(1, 2045, 'Défibrillateur Automatique', 'entree', 5, '2026-04-10 10:00:00', 'Livraison hebdomadaire'),
                new MouvementDTO(2, 1102, 'Paracétamol 500mg', 'sortie', 20, '2026-04-11 14:30:00', 'Besoin urgences'),
                new MouvementDTO(3, 9901, 'Gants Stériles (Taille M)', 'entree', 100, '2026-04-12 09:15:00', 'Réapprovisionnement'),
            ]);
        }
    }

    public function getAll(): Collection
    {
        return self::$mouvements->sortByDesc('date');
    }

    public function create(array $data)
    {
        $id = self::$mouvements->max('id') + 1;
        $mouvement = new MouvementDTO(
            $id,
            $data['equipement_id'],
            $data['nom_equipement'],
            $data['type'],
            $data['quantite'],
            now()->toDateTimeString(),
            $data['commentaire'] ?? null
        );
        self::$mouvements->push($mouvement);
        return $mouvement;
    }
}
