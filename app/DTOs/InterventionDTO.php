<?php

namespace App\DTOs;

use App\Enums\InterventionState;

class InterventionDTO
{
    public function __construct(
        public int $id,
        public int $dossier_id,
        public int $medecin_id,
        public ?int $infirmier_id = null,
        public ?string $compte_rendu = null,
        public InterventionState $state = InterventionState::PLANIFIEE,
        public ?string $patient_nom = null,
        public ?string $medecin_nom = null,
        public ?string $date = null
    ) {}
}
