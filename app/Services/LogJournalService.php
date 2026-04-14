<?php

namespace App\Services;

use App\Models\LogJournal;

class LogJournalService
{
    /**
     * UML: enregistrerAction(action: String, idUtilisateur: int): void
     */
    public function enregistrerAction(string $action, int $idUtilisateur): void
    {
        LogJournal::create([
            'action'        => $action,
            'idUtilisateur' => $idUtilisateur,
        ]);
    }

    /**
     * UML: exporterLogs(): void — Returns all log entries
     */
    public function exporterLogs()
    {
        return LogJournal::with('utilisateur')
            ->latest()
            ->get();
    }
}
