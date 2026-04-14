<?php

namespace App\Services;

use App\Models\Utilisateur;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthService
{
    /**
     * UML: authentifier(login: String, mdp: String): boolean
     * Uses Laravel Hash::check() for secure password comparison.
     */
    public function authentifier(string $login, string $mdp): bool
    {
        $user = Utilisateur::where('login', $login)->first();

        if ($user && Hash::check($mdp, $user->mdp)) {
            Session::put('user_id', $user->id);
            Session::put('user_role', $user->role);
            Session::put('user_name', $user->prenom . ' ' . $user->nom);
            return true;
        }

        return false;
    }

    /**
     * UML: seDeconnecter(): void
     */
    public function seDeconnecter(): void
    {
        Session::forget(['user_id', 'user_role', 'user_name']);
    }

    /**
     * UML: verifierUniciteLogin(): boolean
     * Returns true if login is available (does NOT exist in DB).
     */
    public function verifierUniciteLogin(string $login): bool
    {
        return !Utilisateur::where('login', $login)->exists();
    }
}
