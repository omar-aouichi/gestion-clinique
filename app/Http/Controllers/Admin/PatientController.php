<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\FacturationService;
use App\Models\RendezVous;
use App\Models\Facture;

class PatientController extends Controller
{
    public function __construct(
        protected FacturationService $facturationService
    ) {}

    public function dashboard()
    {
        $patientId = auth()->id();
        $rdvs      = RendezVous::where('patient_id', $patientId)->with('medecin')->get();
        $factures  = Facture::where('patient_id', $patientId)->get();
        return view('patient.dashboard', compact('rdvs', 'factures'));
    }

    public function payFacture($id)
    {
        $this->facturationService->enregistrerPaiement($id);
        return back()->with('success', 'Paiement traité avec succès.');
    }
}
