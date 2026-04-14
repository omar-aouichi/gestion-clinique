<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\EmployeService;
use App\Services\ResponsableRHService;
use App\Services\CadreAdministratifService;
use App\Services\DirecteurGeneralService;
use App\Models\Utilisateur;
use App\Models\Departement;
use App\Models\Demande;

class HRModuleController extends Controller
{
    public function __construct(
        protected EmployeService $employeService,
        protected ResponsableRHService $rhService,
        protected CadreAdministratifService $cadreService,
        protected DirecteurGeneralService $dgService
    ) {}

    // ==================== EMPLOYE ACTOR ====================

    public function employeDashboard()
    {
        $employeId = auth()->id();
        $planning  = $this->employeService->consulterPlanning($employeId);
        return view('employe.dashboard', compact('planning'));
    }

    public function pointer(Request $request)
    {
        $msg = $this->employeService->enregistrerPresence(auth()->id());
        return back()->with('success', $msg);
    }

    public function deposerDemande(Request $request)
    {
        $this->employeService->deposerDemande(auth()->id(), $request->type);
        return back()->with('success', "Demande de {$request->type} déposée avec succès.");
    }

    // ==================== RESPONSABLE RH ACTOR ====================

    public function rhDashboard()
    {
        $depts   = Departement::with('employes')->get();
        $employes = Utilisateur::whereIn('role', ['medecin', 'infirmier', 'secretaire', 'rh', 'gerant_stock'])
            ->with('departement')
            ->get()
            ->map(function ($e) {
                $e->departement_nom = $e->departement?->nom ?? 'Non assigné';
                // Provide a simple state object compatible with old blade templates
                $e->state = (object) ['value' => strtoupper($e->statut ?? 'ACTIF')];
                return $e;
            });

        $pointages = \App\Models\LogJournal::where('action', 'like', 'POINTAGE%')
            ->latest()
            ->take(20)
            ->get();

        return view('rh.dashboard', compact('depts', 'employes', 'pointages'));
    }

    public function modifierEmploye(Request $request, $id)
    {
        $this->rhService->modifierEmploye($id, $request->only(['nom', 'prenom', 'contact']));
        return back()->with('success', 'Employé mis à jour.');
    }

    public function affecter(Request $request)
    {
        Utilisateur::where('id', $request->employe_id)
            ->update(['departement_id' => $request->departement_id]);
        return back()->with('success', 'Employé affecté au département.');
    }

    public function retirer(Request $request)
    {
        Utilisateur::where('id', $request->employe_id)
            ->update(['departement_id' => null]);
        return back()->with('success', 'Employé retiré du département.');
    }

    public function destroy($id)
    {
        $user = Utilisateur::findOrFail($id);
        $name = $user->getFullNameAttribute();
        $user->delete();
        return back()->with('warning', "Employé [{$name}] supprimé définitivement.");
    }

    public function storeDepartement(Request $request)
    {
        Departement::create($request->only('nom'));
        return back()->with('success', 'Département créé.');
    }

    public function destroyDepartement($id)
    {
        Departement::destroy($id);
        return back()->with('warning', 'Département supprimé.');
    }

    // ==================== CADRE ADMINISTRATIF ACTOR ====================

    public function cadreDashboard()
    {
        return view('cadre.dashboard');
    }

    public function soumettreDemande(Request $request)
    {
        $this->cadreService->soumettreDemande(
            $request->type,
            $request->details ?? '',
            auth()->id()
        );
        return back()->with('success', "Demande de {$request->type} envoyée à la direction.");
    }

    // ==================== DIRECTEUR GÉNÉRAL ACTOR ====================

    public function dgDashboard()
    {
        $demandes = Demande::with('employe')->latest()->get()
            ->map(function ($d) {
                $d->state = (object) ['value' => strtoupper($d->statut ?? 'EN_ATTENTE')];
                // Store the employee details clearly for the view
                $d->demandeur_nom = $d->employe ? ($d->employe->prenom . ' ' . $d->employe->nom) : 'Utilisateur Inconnu';
                $d->demandeur_role = $d->employe ? strtoupper($d->employe->role->value) : 'N/A';
                return $d;
            });

        $cadres = Utilisateur::where('role', 'cadre_administratif')->get()
            ->map(function ($c) {
                $c->state = (object) ['value' => strtoupper($c->statut ?? 'ACTIF')];
                return $c;
            });

        return view('dg.dashboard', compact('demandes', 'cadres'));
    }

    public function validerDemande($id, Request $request)
    {
        match ($request->action) {
            'valider'     => $this->dgService->validerBudget($id),
            'recrutement' => $this->dgService->autoriserOuverturePoste("Poste lié à la demande #{$id}"),
            'refuser'     => $this->dgService->notifierRefus($id, "Refus administratif"),
            default       => null,
        };
        return back()->with('success', "Action effectuée sur la demande #{$id}.");
    }

    public function ajouterCadre(Request $request)
    {
        $this->dgService->ajouterCadre([
            'login'         => 'cadre.' . time(),
            'mdp'           => bcrypt('password'),
            'nom'           => $request->nom,
            'prenom'        => 'Cadre',
            'dateNaissance' => '1980-01-01',
            'contact'       => '0600000000',
            'statut'        => 'ACTIF',
        ]);
        return back()->with('success', 'Cadre ajouté avec succès.');
    }

    public function retirerCadre($id)
    {
        $this->dgService->retirerCadre($id);
        return back()->with('success', 'Cadre retiré.');
    }

    public function modifierStatutCadre(Request $request, $id)
    {
        $this->dgService->modifierStatutCadre($id, $request->statut);
        return back()->with('success', 'Statut du cadre modifié.');
    }
}
