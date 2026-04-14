<?php

namespace App\Services;

use App\Models\Utilisateur;
use Illuminate\Support\Str;

/**
 * Administrative patient creation service (secretary-facing).
 * Delegates to the shared STI Utilisateur model.
 */
class PatientAdministrativeService
{
    /**
     * Create a standard registered patient
     */
    public function creerPatientStandard(array $data): Utilisateur
    {
        return Utilisateur::create(array_merge($data, [
            'role'   => 'patient',
            'statut' => 'ACTIF',
            'absences_non_justifiees' => 0,
        ]));
    }

    /**
     * Create an anonymous emergency patient (RG19 — Sous X)
     */
    public function creerPatientSousX(): Utilisateur
    {
        $tempId = 'SOUS-X-' . strtoupper(Str::random(6));
        return Utilisateur::create([
            'login'          => $tempId,
            'mdp'            => bcrypt($tempId),
            'nom'            => 'SOUS X',
            'prenom'         => 'Inconnu',
            'dateNaissance'  => '1900-01-01',
            'contact'        => '0000000000',
            'role'           => 'patient',
            'statut'         => 'ACTIF',
            'absences_non_justifiees' => 0,
        ]);
    }
}
