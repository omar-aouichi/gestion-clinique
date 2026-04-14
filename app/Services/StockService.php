<?php

namespace App\Services;

use App\Models\Equipement;
use App\Models\LogJournal;
use Carbon\Carbon;

class StockService
{
    /**
     * UML: consulter_stock
     */
    public function consulter_stock()
    {
        return Equipement::all();
    }

    /**
     * UML: ajouter_equipement
     */
    public function ajouter_equipement(array $data): Equipement
    {
        return Equipement::create($data);
    }

    /**
     * UML: supprimer_equipement
     */
    public function supprimer_equipement(int $id): bool
    {
        return Equipement::where('id_equipement', $id)->delete() > 0;
    }

    /**
     * UML: calculer_PUMP (Prix Unitaire Moyen Pondéré)
     */
    public function calculer_PUMP(): float
    {
        $stock = Equipement::all();
        $totalVal = $stock->sum(fn($e) => $e->prix * $e->quantite);
        $totalQty = $stock->sum('quantite');
        return $totalQty > 0 ? round($totalVal / $totalQty, 2) : 0.0;
    }

    /**
     * CRITICAL: verifier_date_expiration — Auto-mark expired items
     */
    public function verifier_date_expiration(): void
    {
        Equipement::where('etat', 'VALIDE')
            ->whereNotNull('date_expiration')
            ->where('date_expiration', '<', Carbon::today())
            ->update(['etat' => 'EXPIRE']);
    }

    /**
     * UML: signaler_administratif — Create a log alert for low stock
     */
    public function signaler_administratif(int $id, string $nom): void
    {
        // We use LogJournal as the alert mechanism (traceable & UML-compliant)
        LogJournal::create([
            'idUtilisateur' => 1, // System user
            'action' => "ALERTE STOCK: Seuil critique atteint pour [{$nom}] (ID: {$id})",
        ]);
    }

    /**
     * CRITICAL: verifierSeuilMinimal — Automates signaler_administratif
     */
    public function verifierSeuilMinimal(): void
    {
        $critiques = Equipement::whereColumn('quantite', '<=', 'seuil_minimal')
            ->where('etat', '!=', 'RETIRE')
            ->get();

        foreach ($critiques as $eq) {
            $this->signaler_administratif($eq->id_equipement, $eq->nom);
        }
    }

    /**
     * CRITICAL: enregistrerMouvement — Audit trail for stock in/out
     */
    public function enregistrerMouvement(int $id, string $type, int $qty): array
    {
        $equipement = Equipement::where('id_equipement', $id)->firstOrFail();

        if ($type === 'sortie' && $equipement->quantite < $qty) {
            return ['success' => false, 'message' => 'Stock insuffisant.'];
        }

        $delta = $type === 'sortie' ? -$qty : $qty;
        $equipement->quantite += $delta;
        
        // Reset alert status if stock is replenished above threshold
        if ($equipement->quantite > $equipement->seuil_minimal) {
            $equipement->en_alerte = false;
        }
        
        $equipement->save();

        LogJournal::create([
            'idUtilisateur' => 1,
            'action' => "MOUVEMENT STOCK: {$type} de {$qty} unités — [{$equipement->nom}]",
        ]);

        return ['success' => true, 'message' => "Mouvement enregistré.", 'nouvelle_quantite' => $equipement->quantite];
    }
}
