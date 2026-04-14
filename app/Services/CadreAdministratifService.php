<?php

namespace App\Services;

use App\Models\Demande;

class CadreAdministratifService
{
    /**
     * UML: soumettreDemande — Cadre submits a strategic resource request to DG
     */
    public function soumettreDemande(string $type, string $details, int $cadreId): Demande
    {
        return Demande::create([
            'employe_id'  => $cadreId,
            'type'        => $type,
            'description' => $details,
            'date'        => now()->toDateString(),
            'statut'      => 'EN_ATTENTE',
        ]);
    }

    /**
     * UML: gererPersonnel
     */
    public function gererPersonnel(): string
    {
        return "Personnel assigné aux services de garde.";
    }
}
