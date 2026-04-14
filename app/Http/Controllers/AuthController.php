<?php

namespace App\Http\Controllers;

use App\Models\Utilisateur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    private const ROLE_ROUTES = [
        'admin'               => 'admin.users.index',
        'secretaire'          => 'secretary.appointments',
        'medecin'             => 'medecin.dashboard',
        'infirmier'           => 'infirmier.dashboard',
        'rh'                  => 'rh.dashboard',
        'gerant_stock'        => 'stock.dashboard',
        'cadre_administratif' => 'cadre.dashboard',
        'dg'                  => 'dg.dashboard',
        'patient'             => 'patient.dashboard',
    ];

    public function showLogin()
    {
        // Redirect already-authenticated users to their portal
        if (Auth::check()) {
            return $this->redirectByRole(Auth::user());
        }
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'login'    => 'required|string',
            'password' => 'required|string',
        ]);

        // Auth::attempt finds user by 'login', checks password against getAuthPassword() = 'mdp'
        if (Auth::attempt(['login' => $credentials['login'], 'password' => $credentials['password']], $request->boolean('remember'))) {
            $request->session()->regenerate();
            $user = Auth::user();
            return $this->redirectByRole($user)
                ->with('success', "Bienvenue, {$user->prenom} {$user->nom} !");
        }

        return back()->withErrors([
            'login' => 'Identifiants incorrects. Vérifiez votre login et mot de passe.',
        ])->onlyInput('login');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')->with('info', 'Vous avez été déconnecté avec succès.');
    }

    private function redirectByRole(Utilisateur $user)
    {
        $routeName = self::ROLE_ROUTES[$user->role->value] ?? 'employe.dashboard';
        return redirect()->route($routeName);
    }
}
