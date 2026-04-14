<?php

namespace App\DTOs;

class MouvementDTO
{
    public function __construct(
        public int $id,
        public int $equipement_id,
        public string $nom_equipement,
        public string $type, // entree, sortie
        public int $quantite,
        public string $date,
        public ?string $commentaire = null
    ) {}
}
