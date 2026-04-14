<?php

namespace App\DTOs;

use App\Enums\DemandeState;

class DemandeDTO
{
    public function __construct(
        public int $id,
        public string $type, // recrutement, budget, stock
        public ?int $cadre_id = null,
        public ?DemandeState $state = null,
        public ?string $details = null,
        // Stock specific properties to maintain compatibility
        public ?string $article = null,
        public ?int $quantite = null,
        public ?string $statut = null, // Legacy string status for stock
        public ?string $demandeur = null
    ) {
        // Map legacy status if provided
        if ($this->statut && !$this->state) {
            $this->state = match($this->statut) {
                'Approuvé' => DemandeState::APPROUVEE,
                'Refusé' => DemandeState::REFUSEE,
                default => DemandeState::NOUVELLE
            };
        }
    }
}
