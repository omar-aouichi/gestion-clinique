<?php

namespace App\Services;

use App\Models\Utilisateur;
use App\Models\Departement;
use App\Models\Notification;

class ResponsableRHService
{
    /**
     * UML: ajouterEmploye
     */
    public function ajouterEmploye(array $data): Utilisateur
    {
        return Utilisateur::create($data);
    }

    /**
     * UML: modifierEmploye
     */
    public function modifierEmploye(int $id, array $data): bool
    {
        return Utilisateur::where('id', $id)->update($data) > 0;
    }

    /**
     * UML: supprimerEmploye
     */
    public function supprimerEmploye(int $id): bool
    {
        return Utilisateur::destroy($id) > 0;
    }

    /**
     * UML: gererDepartement — Returns all departments with their employees
     */
    public function gererDepartement()
    {
        return Departement::with('employes')->get();
    }

    /**
     * UML: recevoirNotification — Returns unread notifications for RH manager
     */
    public function recevoirNotification(int $rhId)
    {
        return Notification::where('destinataire_id', $rhId)
            ->latest('date_envoi')
            ->get();
    }
}
