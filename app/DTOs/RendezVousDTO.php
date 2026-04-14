<?php

namespace App\DTOs;

use App\Enums\RendezVousState;

class RendezVousDTO
{
    public function __construct(
        public int $id,
        public int $patient_id,
        public string $patient_nom,
        public string $medecin_id,
        public string $medecin_nom,
        public string $date_header,
        public string $heure,
        public RendezVousState $state
    ) {}
}
