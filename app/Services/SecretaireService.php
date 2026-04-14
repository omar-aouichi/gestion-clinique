<?php

namespace App\Services;

use App\Models\Utilisateur;
use Illuminate\Support\Str;

class SecretaireService
{
    /**
     * UML: creerPatient — Standard admission with auto-generated medical record number
     */
    public function creerPatient(array $data): Utilisateur
    {
        return Utilisateur::create(array_merge($data, [
            'role'   => 'patient',
            'statut' => 'ACTIF',
            'sousX'  => false,
            'absences_non_justifiees' => 0,
        ]));
    }

    /**
     * UML: creerPatientSousX — Emergency intake (RO2, RG19)
     * Patient arrives anonymously — identity filled later.
     */
    public function creerPatientSousX(): Utilisateur
    {
        $tempId = 'SOUS-X-' . strtoupper(Str::random(6));
        return Utilisateur::create([
            'login'          => $tempId,
            'mdp'            => bcrypt($tempId),
            'nom'            => 'Sous X',
            'prenom'         => 'Inconnu',
            'dateNaissance'  => '1900-01-01',
            'contact'        => '0000000000',
            'role'           => 'patient',
            'statut'         => 'ACTIF',
            'sousX'          => true,
            'absences_non_justifiees' => 0,
        ]);
    }

    /**
     * UML: majInfosPatient — Update patient identity info
     */
    public function majInfosPatient(int $patientId, array $data): bool
    {
        return Utilisateur::where('id', $patientId)->update($data) > 0;
    }
}
