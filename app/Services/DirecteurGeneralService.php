<?php

namespace App\Services;

use App\Models\Demande;
use App\Models\LogJournal;
use App\Models\Utilisateur;

class DirecteurGeneralService
{
    /**
     * UML: validerBudget (approuve une demande)
     */
    public function validerBudget(int $demandeId): bool
    {
        $demande = Demande::find($demandeId);
        if (!$demande) return false;

        $demande->update(['statut' => 'VALIDE']);
        return true;
    }

    /**
     * UML: notifierRefus
     */
    public function notifierRefus(int $demandeId, string $motif = 'Refus administratif'): bool
    {
        $demande = Demande::find($demandeId);
        if (!$demande) return false;

        $demande->update(['statut' => 'REFUSE']);
        return true;
    }

    /**
     * UML: ajouterCadre — Promote an employee to a cadre role
     */
    public function ajouterCadre(array $data): Utilisateur
    {
        // A 'cadre' is a user with role='cadre_administratif' in the STI table
        return Utilisateur::create(array_merge($data, ['role' => 'cadre_administratif']));
    }

    /**
     * UML: retirerCadre
     */
    public function retirerCadre(int $id): bool
    {
        return Utilisateur::destroy($id) > 0;
    }

    /**
     * UML: modifierStatutCadre
     */
    public function modifierStatutCadre(int $id, string $status): bool
    {
        return Utilisateur::where('id', $id)->update(['statut' => $status]) > 0;
    }

    /**
     * UML: autoriserOuverturePoste — Logged action (requires traceability)
     */
    public function autoriserOuverturePoste(string $poste): bool
    {
        LogJournal::create([
            'idUtilisateur' => auth()->id() ?? 1,
            'action' => "AUTORISATION OUVERTURE POSTE: {$poste}",
        ]);
        return true;
    }
}
