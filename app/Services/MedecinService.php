<?php

namespace App\Services;

use App\Models\DossierMedical;
use App\Models\Intervention;
use App\Models\Utilisateur;

class MedecinService
{
    /**
     * UML: consulterDossier
     */
    public function consulterDossier(int $patientId): ?DossierMedical
    {
        return DossierMedical::where('patient_id', $patientId)->first();
    }

    /**
     * UML: creerDossier
     */
    public function creerDossier(int $patientId): DossierMedical
    {
        return DossierMedical::create([
            'patient_id' => $patientId,
            'statut'     => 'ACTIF',
            'actes'      => [],
            'resultats_valides' => false,
        ]);
    }

    /**
     * CRITICAL: sePresenter — Sequence Diagram admission flow.
     * Checks for an active dossier; creates one if missing or archived.
     */
    public function sePresenter(int $patientId): DossierMedical
    {
        $dossier = DossierMedical::where('patient_id', $patientId)
            ->where('statut', 'ACTIF')
            ->first();

        if (!$dossier) {
            $dossier = $this->creerDossier($patientId);
        }

        return $dossier;
    }

    /**
     * UML: realiserIntervention — RG18: dossier must be ACTIF
     */
    public function realiserIntervention(int $id): array
    {
        $intervention = Intervention::find($id);
        if (!$intervention) {
            return ['success' => false, 'message' => 'Intervention introuvable.'];
        }

        $dossier = DossierMedical::find($intervention->dossier_id);
        if (!$dossier || $dossier->statut !== 'ACTIF') {
            return ['success' => false, 'message' => 'RG18: Le dossier médical doit être ACTIF.'];
        }

        $intervention->update(['statut' => 'EN_COURS']);
        return ['success' => true, 'message' => "Intervention #{$id} démarrée."];
    }

    /**
     * CRITICAL: validerResultats — RG20: unlock results for patient
     */
    public function validerResultats(int $dossierId): array
    {
        $dossier = DossierMedical::find($dossierId);
        if (!$dossier) {
            return ['success' => false, 'message' => 'Dossier introuvable.'];
        }
        $dossier->update(['resultats_valides' => true]);
        return ['success' => true, 'message' => 'RG20: Résultats validés — le patient peut les consulter.'];
    }

    /**
     * UML: redigerCompteRendu
     */
    public function redigerCompteRendu(int $id, string $text): array
    {
        $intervention = Intervention::findOrFail($id);
        $intervention->update(['compte_rendu' => $text]);
        return ['success' => true, 'message' => 'Compte-rendu enregistré.'];
    }

    /**
     * UML Logic: ajouterActe
     */
    public function ajouterActe(int $dossierId, array $acte): array
    {
        $dossier = DossierMedical::findOrFail($dossierId);
        $actes = $dossier->actes ?? [];
        $actes[] = $acte;
        $dossier->update(['actes' => $actes]);
        return ['success' => true, 'message' => "Acte ajouté au dossier #{$dossierId}."];
    }

    /**
     * UML: archiverDossier
     */
    public function archiverDossier(int $dossierId): array
    {
        $dossier = DossierMedical::findOrFail($dossierId);
        $dossier->update(['statut' => 'ARCHIVE']);
        return ['success' => true, 'message' => 'Dossier archivé.'];
    }
}
