<?php

namespace App\DTOs;

use App\Enums\DossierState;

class DossierMedicalDTO
{
    public function __construct(
        public int $id,
        public int $patient_id,
        public DossierState $state,
        public array $actes = [],
        public bool $resultats_valides = false
    ) {}
}
