<?php

namespace App\Services;

use App\Models\DossierMedical;
use App\Models\Intervention;

class InfirmierService
{
    /**
     * UML: assisterIntervention
     * Uses the 'assiste' pivot table (Many-to-Many).
     */
    public function assisterIntervention(int $interventionId, int $infirmierId = 1): array
    {
        $intervention = Intervention::find($interventionId);
        if (!$intervention) {
            return ['success' => false, 'message' => 'Intervention introuvable.'];
        }

        // Attach via the pivot table (avoids duplicates with sync/attach)
        $intervention->infirmiers()->syncWithoutDetaching([$infirmierId]);

        return [
            'success' => true,
            'message' => "Infirmier assigné à l'intervention #{$interventionId}.",
        ];
    }

    /**
     * UML: mettreAJourDossier — Record nursing vitals as an acte in the dossier
     */
    public function mettreAJourDossier(int $dossierId, array $data): array
    {
        $dossier = DossierMedical::find($dossierId);
        if (!$dossier) {
            return ['success' => false, 'message' => 'Dossier introuvable.'];
        }

        $actes = $dossier->actes ?? [];
        $actes[] = [
            'type'        => 'Note Infirmière',
            'date'        => now()->toDateString(),
            'auteur'      => 'Infirmier(e)',
            'tension'     => $data['tension'] ?? null,
            'temperature' => $data['temperature'] ?? null,
            'pouls'       => $data['pouls'] ?? null,
            'notes'       => $data['notes'] ?? null,
        ];
        $dossier->update(['actes' => $actes]);

        return ['success' => true, 'message' => "Constantes vitales enregistrées dans le dossier #{$dossierId}."];
    }
}
