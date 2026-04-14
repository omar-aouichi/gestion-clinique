<?php

namespace App\Repositories\Mock;

use App\DTOs\DemandeDTO;
use App\Enums\DemandeState;
use App\Repositories\Interfaces\DemandeRepositoryInterface;
use Illuminate\Support\Collection;

class MockDemandeRepository implements DemandeRepositoryInterface
{
    private static ?Collection $demandes = null;

    public function __construct()
    {
        if (self::$demandes === null) {
            self::$demandes = collect([
                // HR Demands
                new DemandeDTO(1, 'budget', 1, DemandeState::NOUVELLE, 'Acquisition scanners IRM', null, null, null, 'Cadre Admin 1'),
                new DemandeDTO(2, 'recrutement', 2, DemandeState::ANALYSEE, 'Poste Infirmier Urgentiste', null, null, null, 'Cadre Admin 2'),
                
                // Stock Demands (Fix for Stock Module compatibility)
                new DemandeDTO(101, 'stock', null, DemandeState::APPROUVEE, 'Besoin urgent de gants', 'Gants Stériles', 50, 'Approuvé', 'Gérant de Stock'),
                new DemandeDTO(102, 'stock', null, DemandeState::NOUVELLE, 'Rupture stock seringues', 'Seringues 5ml', 100, 'En attente', 'Gérant de Stock'),
            ]);
        }
    }

    public function getAll(): Collection
    {
        return self::$demandes;
    }

    public function findById(int $id)
    {
        return self::$demandes->first(fn($d) => $d->id === $id);
    }

    public function create(array $data)
    {
        $id = self::$demandes->max('id') + 1;
        $demande = new DemandeDTO(
            id: $id,
            type: $data['type'],
            cadre_id: $data['cadre_id'] ?? null,
            state: $data['state'] ?? DemandeState::NOUVELLE,
            details: $data['details'] ?? '',
            article: $data['article'] ?? null,
            quantite: $data['quantite'] ?? null,
            statut: $data['statut'] ?? null,
            demandeur: $data['demandeur'] ?? 'N/A'
        );
        self::$demandes->push($demande);
        return $demande;
    }

    public function update(int $id, array $data)
    {
        $demande = $this->findById($id);
        if ($demande) {
            foreach ($data as $key => $value) {
                if (property_exists($demande, $key)) $demande->{$key} = $value;
            }
        }
        return $demande;
    }
}
