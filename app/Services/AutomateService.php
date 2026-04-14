<?php

namespace App\Services;

use App\Models\RendezVous;
use App\Models\LogJournal;
use Carbon\Carbon;

class AutomateService
{
    /**
     * Automated task: Finds appointments happening tomorrow and logs reminders.
     * In production this would be called by a scheduled Artisan command.
     */
    public function verifierEcheanceEtDeclencherRappel(): int
    {
        $tomorrowStart = Carbon::tomorrow()->startOfDay();
        $tomorrowEnd   = Carbon::tomorrow()->endOfDay();
        $count = 0;

        $rdvs = RendezVous::whereBetween('date_heure', [$tomorrowStart, $tomorrowEnd])
            ->whereIn('statut', ['EN_ATTENTE', 'CONFIRME'])
            ->get();

        foreach ($rdvs as $rdv) {
            LogJournal::create([
                'idUtilisateur' => $rdv->patient_id,
                'action' => "RAPPEL H-24: RDV #{$rdv->id} le " . Carbon::parse($rdv->date_heure)->format('d/m/Y H:i'),
            ]);
            $count++;
        }

        return $count;
    }
}
