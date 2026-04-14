<?php

namespace App\DTOs;

use App\Enums\EquipementState;

class EquipementDTO
{
    public function __construct(
        public int $id_equipement,
        public string $nom_equipement,
        public string $categorie_equipement,
        public int $quantite,
        public float $prix,
        public string $date_expiration,
        public EquipementState $etat,
        public ?string $niveau_risque = null,
        public ?string $fonctionnalite = null,
        public ?string $usage = null,
        public int $seuil_minimal = 10
    ) {}

    public function toArray(): array
    {
        return [
            'id_equipement' => $this->id_equipement,
            'nom_equipement' => $this->nom_equipement,
            'categorie_equipement' => $this->categorie_equipement,
            'quantite' => $this->quantite,
            'prix' => $this->prix,
            'date_expiration' => $this->date_expiration,
            'etat' => $this->etat->value,
            'niveau_risque' => $this->niveau_risque,
            'fonctionnalite' => $this->fonctionnalite,
            'usage' => $this->usage,
            'seuil_minimal' => $this->seuil_minimal,
        ];
    }
}
