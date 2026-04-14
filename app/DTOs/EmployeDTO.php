<?php

namespace App\DTOs;

use App\Enums\EmployeState;

class EmployeDTO
{
    public function __construct(
        public int $id,
        public string $nom,
        public int $departement_id,
        public EmployeState $state,
        public ?string $departement_nom = null
    ) {}
}
