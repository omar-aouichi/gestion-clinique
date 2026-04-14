<?php

namespace App\DTOs;

use App\Enums\PatientState;

class PatientDTO
{
    public function __construct(
        public int $id,
        public string $cin,
        public string $nom,
        public string $prenom,
        public string $email,
        public string $telephone,
        public PatientState $state,
        public bool $sousX = false,
        public ?string $medical_record_number = null,
        public int $absences_non_justifiees = 0
    ) {}
}
