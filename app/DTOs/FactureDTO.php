<?php

namespace App\DTOs;

use App\Enums\FactureState;

class FactureDTO
{
    public function __construct(
        public int $id,
        public int $patient_id,
        public string $patient_nom,
        public float $montant,
        public array $details,
        public string $date,
        public FactureState $state
    ) {}
}
