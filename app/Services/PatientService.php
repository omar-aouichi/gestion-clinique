<?php

namespace App\Services;

use App\Models\Utilisateur;
use App\Models\DossierMedical;
use App\Models\RendezVous;
use App\Models\Facture;
use Carbon\Carbon;

class PatientService
{
    /**
     * UML: prendreRDV
     */
    public function prendreRDV(array $data): RendezVous
    {
        return RendezVous::create($data);
    }

    /**
     * UML: annulerRDV — CRITICAL: RG14 penalty check (24h rule)
     */
    public function annulerRDV(int $rdvId): array
    {
        $rdv = RendezVous::find($rdvId);
        if (!$rdv) {
            return ['success' => false, 'message' => 'Rendez-vous introuvable.'];
        }

        $rdvDateTime = Carbon::parse($rdv->date_heure);
        $hoursUntilRdv = Carbon::now()->diffInHours($rdvDateTime, false);

        if ($hoursUntilRdv > 24) {
            // > 24h: free cancellation
            $rdv->update(['statut' => 'ANNULE']);
            return ['success' => true, 'message' => 'Annulé sans pénalité.'];
        } else {
            // <= 24h: RG14 penalty — increment absence count on patient
            $patient = Utilisateur::find($rdv->patient_id);
            if ($patient) {
                $patient->increment('absences_non_justifiees');
            }
            $rdv->update(['statut' => 'ANNULE']);
            return ['success' => false, 'message' => 'Annulation tardive (<24h). Absence non justifiée comptabilisée.'];
        }
    }

    /**
     * UML: consulterSesResultats — CRITICAL: RG20 privacy check
     */
    public function consulterSesResultats(int $patientId): array
    {
        $dossier = DossierMedical::where('patient_id', $patientId)->first();
        if (!$dossier || !$dossier->resultats_valides) {
            return ['success' => false, 'message' => 'Résultats non encore validés par le médecin.'];
        }
        return ['success' => true, 'resultats' => $dossier->actes ?? []];
    }

    /**
     * UML: payerFacture
     */
    public function payerFacture(int $factureId): array
    {
        $facture = Facture::find($factureId);
        if (!$facture) {
            return ['success' => false, 'message' => 'Facture non trouvée.'];
        }
        $facture->update(['etat_paiement' => true]);
        return ['success' => true, 'message' => 'Paiement enregistré avec succès.'];
    }
}
