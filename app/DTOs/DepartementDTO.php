<?php

namespace App\DTOs;

class DepartementDTO
{
    public function __construct(
        public int $id,
        public string $nom_departement
    ) {}
}
