<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\SecretaireService;
use App\Services\FacturationService;
use App\Models\Utilisateur;
use App\Models\RendezVous;
use App\Models\Facture;
use App\Models\LogJournal;
use Illuminate\Http\Request;

class SecretaireController extends Controller
{
    public function __construct(
        protected SecretaireService $secretaireService,
        protected FacturationService $facturationService
    ) {}

    public function dashboard()
    {
        $patients = Utilisateur::where('role', 'patient')->get();
        $rdvs     = RendezVous::with('patient', 'medecin')->latest()->get();
        $factures = Facture::with('patient')->latest()->get();
        $logs     = LogJournal::latest()->take(50)->get();
        return view('secretary.dashboard', compact('patients', 'rdvs', 'factures', 'logs'));
    }

    public function creerPatientSousX()
    {
        $patient = $this->secretaireService->creerPatientSousX();
        
        LogJournal::create([
            'idUtilisateur' => auth()->id(),
            'action'        => "URGENCE VITALE : Création patient Sous X #{$patient->id} (Bypass RG19)",
        ]);

        return back()->with('success', 'Urgence vitale : Patient Sous X créé immédiatement.');
    }

    public function annulerRdv($id)
    {
        RendezVous::where('id', $id)->update(['statut' => 'ANNULE']);
        LogJournal::create([
            'idUtilisateur' => auth()->id(),
            'action'        => "ANNULATION RDV #{$id} par la secrétaire.",
        ]);
        return back()->with('success', 'Le rendez-vous a été annulé.');
    }

    public function suspendrePatient($id)
    {
        Utilisateur::where('id', $id)->update(['statut' => 'SUSPENDU']);
        return back()->with('success', 'Le patient est désormais suspendu.');
    }

    public function annulerFacture(Request $request, $id)
    {
        $this->facturationService->annulerFacture($id, $request->motif ?? 'N/A', session('user_id', 1));
        return back()->with('success', 'Facture annulée et archivée.');
    }
}
