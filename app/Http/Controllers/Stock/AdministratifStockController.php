<?php

namespace App\Http\Controllers\Stock;

use App\Http\Controllers\Controller;
use App\Services\AdministratifStockService;
use App\Models\Commande;
use App\Models\Fournisseur;
use Illuminate\Http\Request;

class AdministratifStockController extends Controller
{
    public function __construct(
        protected AdministratifStockService $service
    ) {}

    public function dashboard()
    {
        $rawAlerts = $this->service->recoit_alerte();
        
        // Enrich alerts with actual equipment data from the database
        $alerts = $rawAlerts->map(function($alert) {
            preg_match('/\(ID:\s*(\d+)\)/', $alert->action, $matches);
            $alert->equipement_id = $matches[1] ?? null;
            $alert->equipement = $alert->equipement_id ? \App\Models\Equipement::find($alert->equipement_id) : null;
            
            // Extract a cleaner message
            preg_match('/ALERTE STOCK:\s*(.*)/', $alert->action, $msgMatches);
            $alert->clean_message = $msgMatches[1] ?? $alert->action;
            return $alert;
        });

        $commandes = $this->service->getAllCommandes();
        $fournisseurs = Fournisseur::all();

        return view('stock.administratif-dashboard', compact('alerts', 'commandes', 'fournisseurs'));
    }

    public function contactFournisseur(Request $request)
    {
        $request->validate([
            'fournisseur_id' => 'required|exists:fournisseurs,id',
            'montant'        => 'required|numeric|min:1',
            'alerte_id'      => 'nullable|exists:log_journals,id',
        ]);

        $produit = null;
        if ($request->filled('alerte_id')) {
            $alerte = \App\Models\LogJournal::find($request->alerte_id);
            if ($alerte) {
                preg_match('/pour \[(.*?)\]/', $alerte->action, $matches);
                $produit = $matches[1] ?? null;
            }
        }

        $this->service->effectuer_commande([
            'fournisseur_id' => $request->fournisseur_id,
            'montant'        => $request->montant,
            'produit'        => $produit ?? 'Matériel divers',
        ]);

        return back()->with('success', 'Commande créée avec succès.');
    }

    public function validerCommande(int $id)
    {
        $this->service->valider_commande($id);
        return back()->with('success', 'Commande validée.');
    }

    public function effectuerPaiement(int $id)
    {
        $commande = Commande::findOrFail($id);
        $this->service->envoyer_montant($id, $commande->montant);
        return back()->with('success', 'Paiement effectué avec succès.');
    }

    public function marquerLivre(int $id)
    {
        $this->service->marquer_comme_livre($id);
        return back()->with('success', 'Commande marquée comme livrée.');
    }

    public function envoyerMontant(Request $request, int $id)
    {
        $this->service->envoyer_montant($id, $request->montant ?? 0);
        return back()->with('success', 'Fonds envoyés au fournisseur.');
    }

    public function effectuerCommande(Request $request)
    {
        $request->validate([
            'fournisseur_id' => 'required|exists:fournisseurs,id',
            'montant'        => 'required|numeric|min:1',
        ]);

        $this->service->effectuer_commande([
            'fournisseur_id' => $request->fournisseur_id,
            'montant'        => $request->montant,
        ]);

        return back()->with('success', "Nouvelle commande initialisée.");
    }

    public function envoyerFacture(int $id)
    {
        $this->service->envoyer_facture($id);
        return back()->with('success', 'Transaction complétée. Documents archivés.');
    }
}
