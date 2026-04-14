<?php

namespace App\Services;

use App\Models\Utilisateur;

class UtilisateurService
{
    /**
     * UML: valider(donnees: array): void
     */
    public function valider(array $donnees): void
    {
        if (empty($donnees['contact'])) {
            throw new \Exception("Le contact est obligatoire.");
        }
    }

    /**
     * UML: modifierProfil(donnees: Map): boolean
     */
    public function modifierProfil(int $id, array $donnees): bool
    {
        $this->valider($donnees);

        $updatableFields = array_intersect_key($donnees, array_flip(['contact', 'nom', 'prenom']));
        return Utilisateur::where('id', $id)->update($updatableFields) > 0;
    }
}
