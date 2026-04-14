<?php

namespace App\DTOs;

use App\Enums\CommandeState;

class CommandeDTO
{
    public function __construct(
        public int $id_commande,
        public string $date_commande,
        public ?string $date_livraison,
        public CommandeState $etat,
        public float $montant,
        public string $fournisseur_nom
    ) {}

    public function toArray(): array
    {
        return [
            'id_commande' => $this->id_commande,
            'date_commande' => $this->date_commande,
            'date_livraison' => $this->date_livraison,
            'etat' => $this->etat->value,
            'montant' => $this->montant,
            'fournisseur_nom' => $this->fournisseur_nom,
        ];
    }
}
