<?php

namespace App\Services;

use App\Models\Utilisateur;
use App\Models\LogJournal;
use Illuminate\Support\Facades\Hash;

class AdminTechniqueService
{
    public function __construct(
        protected LogJournalService $logService
    ) {}

    /**
     * UML: ajouterUtilisateur — Creates a system user with unique login check
     */
    public function ajouterUtilisateur(array $data): void
    {
        if (Utilisateur::where('login', $data['login'])->exists()) {
            throw new \Exception("Cet identifiant est déjà utilisé.");
        }

        $data['mdp'] = Hash::make($data['mdp']);
        $user = Utilisateur::create($data);

        $this->logService->enregistrerAction(
            "CRÉER UTILISATEUR: {$user->login} (Role: {$user->role->value})",
            auth()->id() ?? 1
        );
    }

    /**
     * UML: modifierUtilisateur
     */
    public function modifierUtilisateur(int $id, array $data): void
    {
        if (isset($data['mdp'])) {
            $data['mdp'] = Hash::make($data['mdp']);
        }

        Utilisateur::where('id', $id)->update($data);

        $this->logService->enregistrerAction(
            "MODIFIER UTILISATEUR ID: {$id}",
            auth()->id() ?? 1
        );
    }

    /**
     * UML: supprimerUtilisateur
     */
    public function supprimerUtilisateur(int $id): void
    {
        $user = Utilisateur::find($id);
        if ($user) {
            $login = $user->login;
            $user->delete();
            $this->logService->enregistrerAction(
                "SUPPRIMER UTILISATEUR: {$login}",
                auth()->id() ?? 1
            );
        }
    }

    /**
     * UML: resetPassword — CRITICAL security method
     */
    public function resetPassword(int $id): bool
    {
        $user = Utilisateur::find($id);
        if (!$user) return false;

        $newPassword = 'Temp@' . rand(1000, 9999);
        $user->update(['mdp' => Hash::make($newPassword)]);

        $this->logService->enregistrerAction(
            "RESET MOT DE PASSE: {$user->login}",
            auth()->id() ?? 1
        );

        return true;
    }

    /**
     * UML: declencherBackup
     */
    public function declencherBackup(): void
    {
        // In production: trigger artisan backup:run via a queue job
        $this->logService->enregistrerAction(
            "SAUVEGARDE SYSTÈME DÉCLENCHÉE",
            auth()->id() ?? 1
        );
    }

    /**
     * UML: configurerDroits
     */
    public function configurerDroits(): array
    {
        $this->logService->enregistrerAction(
            "CONFIGURATION DES DROITS D'ACCÈS",
            auth()->id() ?? 1
        );
        return ['READ_ALL', 'WRITE_STOCK', 'MANAGE_USERS'];
    }

    /**
     * UML: consulterLogs
     */
    public function consulterLogs()
    {
        return $this->logService->exporterLogs();
    }
}
