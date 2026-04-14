<?php

namespace App\Services;

use App\Models\RendezVous;
use Carbon\Carbon;

class RendezVousService
{
    /**
     * UML: verifierDisponibilites — Check for scheduling conflicts
     */
    public function verifierDisponibilites(Carbon $date, int $medecinId): bool
    {
        // A conflict exists if the doctor has another appointment within 30 minutes
        $from = $date->copy()->subMinutes(30);
        $to   = $date->copy()->addMinutes(30);

        return !RendezVous::where('medecin_id', $medecinId)
            ->whereBetween('date_heure', [$from, $to])
            ->whereIn('statut', ['EN_ATTENTE', 'CONFIRME'])
            ->exists();
    }

    /**
     * UML: planifierRDV
     */
    public function planifierRDV(array $data): ?RendezVous
    {
        $date = Carbon::parse($data['date_heure']);

        if (!$this->verifierDisponibilites($date, $data['medecin_id'])) {
            return null; // Conflict detected
        }

        return RendezVous::create(array_merge($data, ['statut' => 'EN_ATTENTE']));
    }

    /**
     * UML: mettreAJourStatut
     */
    public function mettreAJourStatut(int $rdvId, string $nouveauStatut): bool
    {
        $rdv = RendezVous::find($rdvId);
        if (!$rdv) return false;
        $rdv->update(['statut' => $nouveauStatut]);
        return true;
    }

    /**
     * UML: getMesRendezVous
     */
    public function getMesRendezVous(int $patientId)
    {
        return RendezVous::where('patient_id', $patientId)
            ->with('medecin')
            ->orderBy('date_heure')
            ->get();
    }

    /**
     * UML: annulerRDV (simple — no penalty, that's in PatientService)
     */
    public function annulerRDV(int $rdvId): bool
    {
        return $this->mettreAJourStatut($rdvId, 'ANNULE');
    }

    /**
     * UML: modifierDate
     */
    public function modifierDate(int $rdvId, Carbon $newDate): bool
    {
        $rdv = RendezVous::find($rdvId);
        if (!$rdv || !$this->verifierDisponibilites($newDate, $rdv->medecin_id)) {
            return false;
        }
        $rdv->update(['date_heure' => $newDate]);
        return true;
    }
}
