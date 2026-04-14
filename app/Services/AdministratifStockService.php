<?php

namespace App\Services;

use App\Models\Commande;
use App\Models\LogJournal;

class AdministratifStockService
{
    /**
     * UML: effectuer_commande — Create a new purchase order
     */
    public function effectuer_commande(array $data): Commande
    {
        return Commande::create(array_merge($data, [
            'date_commande' => now()->toDateString(),
            'etat'          => 'CREEE',
        ]));
    }

    /**
     * UML: valider_commande
     */
    public function valider_commande(int $commandeId): bool
    {
        return Commande::where('id', $commandeId)->update(['etat' => 'VALIDE']) > 0;
    }

    /**
     * UML: marquer_comme_livre
     */
    public function marquer_comme_livre(int $commandeId): bool
    {
        return Commande::where('id', $commandeId)->update([
            'etat'           => 'LIVRE',
            'date_livraison' => now()->toDateString(),
        ]) > 0;
    }

    /**
     * UML: envoyer_montant — Record payment dispatch
     */
    public function envoyer_montant(int $commandeId, float $montant): bool
    {
        LogJournal::create([
            'idUtilisateur' => auth()->id() ?? 1,
            'action' => "PAIEMENT FOURNISSEUR: Commande #{$commandeId} — Montant: {$montant} DH",
        ]);
        return true;
    }

    /**
     * UML: envoyer_facture
     */
    public function envoyer_facture(int $commandeId): bool
    {
        LogJournal::create([
            'idUtilisateur' => auth()->id() ?? 1,
            'action' => "FACTURE ENVOYÉE: Commande #{$commandeId}",
        ]);
        return true;
    }

    /**
     * UML: details_commande
     */
    public function details_commande(int $commandeId): ?Commande
    {
        return Commande::with('fournisseur')->find($commandeId);
    }

    /**
     * Get all commandes with fournisseur details
     */
    public function getAllCommandes()
    {
        return Commande::with('fournisseur')->latest()->get();
    }

    /**
     * UML: recoit_alerte — Read pending stock alerts from LogJournal
     */
    public function recoit_alerte()
    {
        return LogJournal::where('action', 'like', 'ALERTE STOCK:%')
            ->latest()
            ->get();
    }
}
