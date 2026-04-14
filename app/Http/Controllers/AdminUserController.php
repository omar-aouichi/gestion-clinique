<?php

namespace App\Http\Controllers;

use App\Services\AdminTechniqueService;
use App\Models\Utilisateur;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    public function __construct(
        protected AdminTechniqueService $adminService
    ) {}

    public function index()
    {
        $users = Utilisateur::orderBy('nom')->get();
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        $roles = \App\Enums\UserRole::cases();
        return view('admin.users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'login'    => 'required|unique:utilisateurs,login',
            'nom'      => 'required',
            'prenom'   => 'required',
            'contact'  => 'required',
            'role'     => 'required',
        ]);

        // Default values for fields missing in the public simplified form
        $data = array_merge($data, [
            'mdp'           => 'password',
            'dateNaissance' => '1990-01-01',
            'statut'        => 'ACTIF',
        ]);

        $this->adminService->ajouterUtilisateur($data);

        return redirect()->route('admin.users.index')
            ->with('success', 'Utilisateur créé. Action enregistrée dans les logs.');
    }

    public function edit($id)
    {
        $user  = Utilisateur::findOrFail($id);
        $roles = \App\Enums\UserRole::cases();
        return view('admin.users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'login'   => 'required',
            'nom'     => 'required',
            'prenom'  => 'required',
            'contact' => 'required',
            'role'    => 'required',
        ]);

        $this->adminService->modifierUtilisateur($id, $data);

        return redirect()->route('admin.users.index')
            ->with('success', 'Profil utilisateur mis à jour (Log enregistré).');
    }

    public function destroy($id)
    {
        $this->adminService->supprimerUtilisateur($id);
        return redirect()->route('admin.users.index')->with('success', 'Utilisateur supprimé.');
    }

    public function logs()
    {
        $logs = $this->adminService->consulterLogs();
        return view('admin.logs.index', compact('logs'));
    }

    public function backup()
    {
        $this->adminService->declencherBackup();
        return back()->with('success', 'Sauvegarde système déclenchée (Log enregistré).');
    }

    public function resetPassword($id)
    {
        $this->adminService->resetPassword($id);
        return back()->with('success', 'Mot de passe réinitialisé avec succès.');
    }
}
