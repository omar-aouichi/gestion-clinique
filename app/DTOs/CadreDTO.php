<?php

namespace App\DTOs;

use App\Enums\CadreState;

class CadreDTO
{
    public function __construct(
        public int $id,
        public string $nom,
        public array $droits,
        public CadreState $state
    ) {}
}
