<?php

namespace App\Http\Controllers\Secretary;

use App\Http\Controllers\Controller;
use App\Services\SecretaireService;
use App\Services\RendezVousService;
use App\Services\FacturationService;
use App\Models\Utilisateur;
use App\Models\Facture;
use App\Models\DossierMedical;
use Illuminate\Http\Request;

class SecretaryController extends Controller
{
    public function __construct(
        protected SecretaireService $secretaireService,
        protected RendezVousService $rdvService,
        protected FacturationService $factureService
    ) {}

    public function appointments()
    {
        $doctors = Utilisateur::where('role', 'medecin')->get();
        $infirmiers = Utilisateur::where('role', 'infirmier')->get();
        // For now, we fetch all appointments for the planner
        $appointments = \App\Models\RendezVous::with(['patient', 'medecin', 'infirmier'])->get();
        
        return view('secretary.appointments', compact('doctors', 'infirmiers', 'appointments'));
    }

    public function create()
    {
        return view('secretary.create-patient');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'login'    => 'required|unique:utilisateurs,login', // This is mapped from CIN
            'nom'      => 'required|string',
            'prenom'   => 'required|string',
            'contact'  => 'required|string', // This is mapped from telephone
            'dateNaissance' => 'required|date',
        ]);

        $validated['mdp'] = bcrypt($validated['login']);
        $validated['role'] = 'patient';
        
        $this->secretaireService->creerPatient($validated);

        return redirect()->route('secretary.patients')
            ->with('success', "Patient [{$validated['prenom']} {$validated['nom']}] inscrit avec succès.");
    }

    public function storeUrgence()
    {
        // Special placeholder for unknown identity (RG03 Bypass)
        $data = [
            'login'         => 'SOUS-X-' . time(),
            'mdp'           => bcrypt('emergency'),
            'nom'           => 'SOUS X',
            'prenom'        => 'PATIENT',
            'dateNaissance' => '1900-01-01',
            'contact'       => 'INCONNU',
            'role'          => 'patient',
        ];

        $this->secretaireService->creerPatient($data);
        
        return redirect()->route('secretary.patients')
            ->with('warning', 'ALERTE URGENCE: Dossier anonyme "Sous X" créé immédiatement.');
    }

    public function patients()
    {
        $patients = Utilisateur::where('role', 'patient')
            ->orderBy('nom')
            ->get();
        return view('secretary.patients', compact('patients'));
    }

    public function facturation()
    {
        $factures = Facture::with('patient')->latest()->get();
        return view('secretary.facturation', compact('factures'));
    }

    public function updatePatient(Request $request, $id)
    {
        $this->secretaireService->majInfosPatient($id, $request->only(['nom', 'prenom', 'contact']));
        return back()->with('success', 'Infos patient mises à jour.');
    }

    public function updateAppointmentStatus(Request $request, $id)
    {
        $this->rdvService->mettreAJourStatut($id, $request->status);
        return back()->with('success', 'Statut du rendez-vous mis à jour.');
    }

    public function emettreRecu($id)
    {
        $msg = $this->factureService->emettreRecu($id);
        return back()->with('success', $msg);
    }

    public function consulterDossier($id)
    {
        $patient = Utilisateur::findOrFail($id);
        $dossier = DossierMedical::where('patient_id', $id)->first();
        return view('secretary.dossier', compact('patient', 'dossier'));
    }

    public function encaisser($id)
    {
        $this->factureService->enregistrerPaiement($id);
        return back()->with('success', "Paiement de la facture #{$id} enregistré.");
    }

    public function storeFacture(Request $request)
    {
        $request->validate([
            'patient_id' => 'required|exists:utilisateurs,id',
            'montant'    => 'required|numeric|min:0',
        ]);

        $this->factureService->genererFacture(
            $request->patient_id, 
            $request->montant, 
            auth()->id()
        );

        return back()->with('success', 'Facture générée avec succès.');
    }

    public function bookAppointment(Request $request)
    {
        // Simple booking logic for now
        \App\Models\RendezVous::create([
            'patient_id'   => $request->patient_id,
            'medecin_id'   => $request->medecin_id,
            'infirmier_id' => $request->infirmier_id,
            'type'         => $request->type,
            'date_heure'   => $request->date . ' ' . $request->heure,
            'statut'       => 'CONFIRME'
        ]);

        return back()->with('success', 'Rendez-vous réservé avec succès.');
    }
}
