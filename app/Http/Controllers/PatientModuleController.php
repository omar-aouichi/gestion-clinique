<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PatientService;
use App\Services\MedecinService;
use App\Services\InfirmierService;
use App\Models\Utilisateur;
use App\Models\DossierMedical;
use App\Models\Intervention;
use App\Models\RendezVous;
use App\Models\Facture;

class PatientModuleController extends Controller
{
    public function __construct(
        protected PatientService $patientService,
        protected MedecinService $medecinService,
        protected InfirmierService $infirmierService
    ) {}

    // ==================== PATIENT ACTOR ====================

    public function patientDashboard()
    {
        $patientId = auth()->id();

        $patient  = auth()->user();
        $dossier  = DossierMedical::where('patient_id', $patientId)->first();
        $rdvs     = RendezVous::where('patient_id', $patientId)->with('medecin')->get();
        $factures = Facture::where('patient_id', $patientId)->get();

        $data = [
            'dossier'              => $dossier,
            'resultats_disponibles'=> $dossier ? $dossier->resultats_valides : false,
            'actes_visibles'       => ($dossier && $dossier->resultats_valides) ? $dossier->actes : [],
        ];

        return view('patient.dashboard-medical', compact('data', 'rdvs', 'factures', 'patient'));
    }

    public function annulerRdv(int $id)
    {
        $result = $this->patientService->annulerRDV($id);
        return back()->with($result['success'] ? 'success' : 'error', $result['message']);
    }

    public function payerFacture(int $id)
    {
        $result = $this->patientService->payerFacture($id);
        return back()->with($result['success'] ? 'success' : 'error', $result['message']);
    }

    // ==================== MEDECIN ACTOR ====================

    public function medecinDashboard()
    {
        $medecinId    = auth()->id();
        $interventions = Intervention::where('medecin_id', $medecinId)
            ->with('dossier.patient')
            ->orderBy('date', 'desc')
            ->get()
            ->map(function ($i) {
                $i->patient_nom = $i->dossier?->patient?->nom . ' ' . $i->dossier?->patient?->prenom;
                $i->medecin_nom = 'Dr. ' . optional(Utilisateur::find($i->medecin_id))->nom;
                return $i;
            });

        $patients = Utilisateur::where('role', 'patient')->get();

        return view('medecin.dashboard', compact('interventions', 'patients'));
    }

    public function consulterDossier(int $patientId)
    {
        $dossier  = $this->medecinService->sePresenter($patientId);
        $patient  = Utilisateur::find($patientId);
        $interventions = Intervention::where('dossier_id', $dossier->id)->get();

        $result = [
            'message' => 'Dossier consulté — Accès autorisé (RG18).',
            'new_dossier' => false,
        ];

        return view('medecin.intervention', compact('dossier', 'patient', 'interventions', 'result'));
    }

    public function demarrerIntervention(int $id)
    {
        $result = $this->medecinService->realiserIntervention($id);
        return back()->with($result['success'] ? 'success' : 'error', $result['message']);
    }

    public function cloturerIntervention(int $id)
    {
        Intervention::where('id', $id)->update(['statut' => 'TERMINEE']);
        return back()->with('success', 'Intervention clôturée avec succès.');
    }

    public function sauvegarderCompteRendu(Request $request, int $id)
    {
        $result = $this->medecinService->redigerCompteRendu($id, $request->compte_rendu);
        return back()->with($result['success'] ? 'success' : 'error', $result['message']);
    }

    public function ajouterActe(Request $request, int $dossierId)
    {
        $acte = [
            'type'   => $request->type_acte,
            'date'   => now()->toDateString(),
            'medecin'=> 'Dr. ' . auth()->user()->nom,
        ];
        $result = $this->medecinService->ajouterActe($dossierId, $acte);
        return back()->with($result['success'] ? 'success' : 'error', $result['message']);
    }

    public function validerResultats(int $dossierId)
    {
        $result = $this->medecinService->validerResultats($dossierId);
        return back()->with($result['success'] ? 'success' : 'error', $result['message']);
    }

    public function archiveDossier(int $id)
    {
        $dossier = DossierMedical::where('patient_id', $id)->where('statut', 'ACTIF')->first();
        if (!$dossier) {
            return back()->with('error', 'Aucun dossier actif trouvé pour ce patient.');
        }

        $result = $this->medecinService->archiverDossier($dossier->id);
        return back()->with($result['success'] ? 'success' : 'error', $result['message']);
    }

    // ==================== INFIRMIER ACTOR ====================

    public function infirmierDashboard()
    {
        $interventions = Intervention::with('dossier.patient', 'medecin', 'infirmiers')
            ->orderBy('date', 'desc')
            ->get()
            ->map(function ($i) {
                $i->patient_nom = $i->dossier?->patient?->nom . ' ' . $i->dossier?->patient?->prenom;
                $i->medecin_nom = 'Dr. ' . optional($i->medecin)->nom;
                $i->infirmier_id = $i->infirmiers->first()?->id; // first assigned nurse
                return $i;
            });

        return view('infirmier.dashboard', compact('interventions'));
    }

    public function assisterIntervention(int $id)
    {
        $infirmierId = auth()->id();
        $result = $this->infirmierService->assisterIntervention($id, $infirmierId);
        return back()->with($result['success'] ? 'success' : 'error', $result['message']);
    }

    public function mettreAJourDossier(Request $request, int $dossierId)
    {
        $result = $this->infirmierService->mettreAJourDossier($dossierId, $request->only([
            'tension', 'temperature', 'pouls', 'notes'
        ]));
        return back()->with($result['success'] ? 'success' : 'error', $result['message']);
    }
}
