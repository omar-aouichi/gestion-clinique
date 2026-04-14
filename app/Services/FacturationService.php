<?php

namespace App\Services;

use App\Models\Facture;
use App\Models\LogJournal;

class FacturationService
{
    /**
     * UML: genererFacture
     */
    public function genererFacture(int $patientId, float $montant, ?int $secretaireId = null): Facture
    {
        return Facture::create([
            'patient_id'    => $patientId,
            'secretaire_id' => $secretaireId,
            'montant'       => $montant,
            'date_emission' => now()->toDateString(),
            'etat_paiement' => false,
        ]);
    }

    /**
     * UML: enregistrerPaiement
     */
    public function enregistrerPaiement(int $factureId): bool
    {
        $facture = Facture::find($factureId);
        if (!$facture) return false;
        $facture->update(['etat_paiement' => true]);
        return true;
    }

    /**
     * UML: annulerFacture — Requires audit log (traceability)
     */
    public function annulerFacture(int $factureId, string $motif, int $utilisateurId): bool
    {
        $facture = Facture::find($factureId);
        if (!$facture) return false;

        $facture->delete(); // Or you can add a 'statut' column and set it to ANNULEE

        LogJournal::create([
            'idUtilisateur' => $utilisateurId,
            'action'        => "ANNULATION FACTURE #{$factureId} — Motif: {$motif}",
        ]);

        return true;
    }

    /**
     * UML: emettreRecu
     */
    public function emettreRecu(int $factureId): string
    {
        $facture = Facture::find($factureId);
        return $facture
            ? "Reçu officiel — Facture #{$factureId} — Montant: {$facture->montant} DH — Réglé le " . now()->format('d/m/Y')
            : "Facture introuvable.";
    }

    /**
     * UML: getFacturesImpayees
     */
    public function getFacturesImpayees()
    {
        return Facture::where('etat_paiement', false)->get();
    }

    /**
     * Get all invoices for a specific patient
     */
    public function getMesFactures(int $patientId)
    {
        return Facture::where('patient_id', $patientId)->get();
    }
}
