<?php

namespace App\Http\Controllers\Stock;

use App\Http\Controllers\Controller;
use App\Services\StockService;
use App\Models\LogJournal;
use Illuminate\Http\Request;

class GerantStockController extends Controller
{
    public function __construct(
        protected StockService $stockService
    ) {}

    public function index()
    {
        $this->stockService->verifier_date_expiration();
        $equipements = $this->stockService->consulter_stock();
        $pump        = $this->stockService->calculer_PUMP();
        
        // Fetch items where quantity is below or equal to threshold and not currently alerted
        $alertes = \App\Models\Equipement::whereColumn('quantite', '<=', 'seuil_minimal')
            ->where('etat', '!=', 'RETIRE')
            ->where('en_alerte', false)
            ->get();

        return view('gerant-stock.dashboard', compact('equipements', 'pump', 'alertes'));
    }

    public function createMouvement()
    {
        $equipements = $this->stockService->consulter_stock();
        $demandes    = \App\Models\Demande::with('employe')->where('type', 'like', '%STOCK%')->latest()->take(10)->get();
        
        $demandes = $demandes->map(function($d) {
            $parts = explode('|', $d->description);
            $d->article = $parts[0] ?? 'Article inconnu';
            $d->quantite = $parts[1] ?? 'N/A';
            $d->demandeur = $parts[2] ?? ($d->employe->nom ?? 'Inconnu');
            $d->type = str_contains($d->type, 'ENTREE') ? 'entree' : 'sortie';
            return $d;
        });

        return view('gerant-stock.mouvement', compact('equipements', 'demandes'));
    }

    public function storeMouvement(Request $request)
    {
        $request->validate([
            'id_equipement' => 'required|integer',
            'type'          => 'required|in:entree,sortie',
            'quantite'      => 'required|integer|min:1',
        ]);

        $result = $this->stockService->enregistrerMouvement(
            $request->id_equipement,
            $request->type,
            $request->quantite
        );

        if ($result['success']) {
            $equipement = \App\Models\Equipement::find($request->id_equipement);
            $desc = ($equipement ? $equipement->nom : 'Article') . '|' . $request->quantite . '|Gérant de Stock';
            \App\Models\Demande::create([
                'employe_id' => auth()->id() ?? 1,
                'type' => $request->type === 'entree' ? 'ENTREE_STOCK' : 'SORTIE_STOCK',
                'date' => now(),
                'statut' => 'Approuvé',
                'description' => $desc,
            ]);
        }

        return $result['success']
            ? redirect()->route('stock.dashboard')->with('success', $result['message'])
            : back()->with('error', $result['message'])->withInput();
    }

    public function storeEquipement(Request $request)
    {
        $request->validate([
            'nom'      => 'required|string',
            'categorie'=> 'required|string',
            'quantite' => 'required|integer|min:0',
            'prix'     => 'required|numeric|min:0',
        ]);

        $this->stockService->ajouter_equipement([
            'nom'            => $request->nom,
            'categorie'      => $request->categorie ?? 'Général',
            'quantite'       => $request->quantite,
            'prix'           => $request->prix ?? 0,
            'etat'           => 'VALIDE',
            'seuil_minimal'  => $request->seuil ?? 5,
            'date_expiration'=> $request->date_expiration ?? null,
        ]);

        return back()->with('success', 'Équipement ajouté au stock avec succès.');
    }

    public function destroyEquipement($id)
    {
        $this->stockService->supprimer_equipement($id);
        return back()->with('success', "Équipement retiré de l'inventaire.");
    }

    public function signaler($id)
    {
        $eq = \App\Models\Equipement::findOrFail($id);
        $this->stockService->signaler_administratif($id, $eq->nom);
        
        // Hide the alert from the dashboard since action has been taken
        $eq->update(['en_alerte' => true]);

        return back()->with('success', "Alerte envoyée à l'administratif pour [{$eq->nom}].");
    }
}
