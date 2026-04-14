<?php

namespace App\Services;

use App\Models\Utilisateur;
use App\Models\Demande;

class EmployeService
{
    /**
     * UML: consulterPlanning — Returns the employee's weekly schedule
     * (Could be a real schedule table in a future phase)
     */
    public function consulterPlanning(int $employeId = 1): array
    {
        // Placeholder — a real schedule table would be queried here
        return [
            ['jour' => 'Lundi',    'shift' => '08:00 - 16:00'],
            ['jour' => 'Mardi',    'shift' => '08:00 - 16:00'],
            ['jour' => 'Mercredi', 'shift' => 'Repos'],
            ['jour' => 'Jeudi',    'shift' => '08:00 - 16:00'],
            ['jour' => 'Vendredi', 'shift' => '08:00 - 14:00'],
        ];
    }

    /**
     * UML: enregistrerPresence — Pointer (time-stamp attendance)
     */
    public function enregistrerPresence(int $employeId): string
    {
        // A real implementation would insert into a 'presences' table
        return "Présence enregistrée à " . now()->toTimeString() . " pour l'employé #{$employeId}.";
    }

    /**
     * UML: deposerDemande — Submit an HR request (congé, démission, etc.)
     */
    public function deposerDemande(int $employeId, string $type): bool
    {
        Demande::create([
            'employe_id' => $employeId,
            'type'       => $type,
            'date'       => now()->toDateString(),
            'statut'     => 'EN_ATTENTE',
        ]);

        if ($type === 'demission') {
            Utilisateur::where('id', $employeId)->update(['statut' => 'DEMISSIONNAIRE']);
        }

        return true;
    }
}
